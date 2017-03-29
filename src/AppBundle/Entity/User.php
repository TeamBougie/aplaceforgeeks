<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 11/03/2017
 * Time: 15:12
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Criteria;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const GENDER_MALE ='Male';
    const GENDER_FEMALE = 'Female';
    const GENDER_UNSPECIFIED = 'Unspecified';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\Post",
     *     mappedBy="author"
     * )
     */
    private $posts;
    /**
     * @var string
     * @Assert\Length(max=160)
     * @ORM\Column(name="avatar", type="string", length=160, nullable=true)
     *
     */
    private $avatar;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=20)
     * @ORM\Column(name="gender", type="string", length=20)
     */
    private $gender;
    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    //todo
    private $country;
    /**
     * @var string
     * @Assert\Length(max=160)
     * @ORM\Column(name="description", type="string", length=160, nullable=true)
     */
    private $description;

    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
        $this->gender = self::GENDER_UNSPECIFIED;
        //todo default values
    }

    /**
     * Add post
     *
     * @param Post $post
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;
        $post->setAuthor($this);
    }
    /**
     * Remove task
     *
     * @param \AppBundle\Entity\Post $post
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);
    }
    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts():ArrayCollection
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('status', Post::STATUS_ACTIVE));
        return $this->posts->matching($criteria);
    }
    /**
     * @param $avatar
     */
    public function setAvatar(String $avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getAvatar():String
    {
        return $this->avatar;
    }
    /**
     * @param $gender
     */
    public function setGender(String $gender)
    {
        if($gender != self::GENDER_UNSPECIFIED && $gender != self::GENDER_MALE && $gender != self::GENDER_FEMALE)
        {
            throw new InvalidArgumentException();
        }
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getGender():String
    {
        return $this->gender;
    }

    /**
     * @param $birthday
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getBirthday():DateTime
    {
        return $this->birthday;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCountry():Country
    {
        return $this->country;
    }

    /**
     * @param $description
     */
    public function setDescription(String $description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription():String
    {
        return $this->description;
    }
}