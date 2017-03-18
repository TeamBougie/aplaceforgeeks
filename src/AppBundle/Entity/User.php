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

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
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

    public function __construct()
    {
        parent::__construct();
        $this->posts = new ArrayCollection();
    }

    /**
     * Add post
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Category
     */
    public function addPost(\AppBundle\Entity\Post $post)
    {
        $this->posts[] = $post;
        $post->setAuthor($this);
    }
    /**
     * Remove task
     *
     * @param \AppBundle\Entity\Post $post
     */
    public function removePost(\AppBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }
    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('status', Post::STATUS_ACTIVE));
        return $this->posts->matching($criteria);
    }

}