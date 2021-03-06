<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 12/03/2017
 * Time: 21:53
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post.
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    const STATUS_ACTIVE ='active';
    const STATUS_CLOSED = 'closed';

    //Constructor
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->status = self::STATUS_ACTIVE;
        $this->title = "";
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=160, maxMessage = "Your Tweet cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="title", type="string", length=160)
     */
    private $title = "";
    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * @var string
     * @Assert\Length(max=200, maxMessage = "Your Tweet cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="url", type="string", length=200)
     */
    private $url;
    /**
     * @var string
     * @Assert\Length(max=160, maxMessage = "Your Tweet cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="description", type="string", length=160)
     */
    private $description = "";
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status;
    /**
     * @var User
     * @ORM\ManyToOne(
     *     targetEntity="AppBundle\Entity\User",
     *     inversedBy="posts"
     * )
     */
    private $author;
    /**
     * Get id.
     *
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set id.
     * @param $value
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get title.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set title.
     * @param $value
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get createdAt.
     * @return \DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt.
     * @param $value
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get url.
     * @return string
     */
    public function getUrl():String
    {
        return $this->url;
    }

    /**
     * Set url.
     * @param $value
     */
    public function setUrl(String $url)
    {
        $this->url = $url;
    }
    public function setDescription(String $description)
    {
        $this->description = $description;
    }
    public function getDescription():String
    {
        return $this->description;
    }

    /**
     * @param $status
     */
    public function setStatus(String $status)
    {
        if($status != self::STATUS_ACTIVE && $status != self::STATUS_CLOSED)
        {
            throw new InvalidArgumentException();
        }
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus():String
    {
        return $this->status;
    }
    /**
     * Set author
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Task
     */
    public function setAuthor(User $user)
    {
        $this->author = $user;
    }
    /**
     * Get author
     *
     * @return \AppBundle\Entity\User
     */
    public function getAuthor():User
    {
        return $this->author;
    }

}