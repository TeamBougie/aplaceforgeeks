<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Avatar.
 *
 * @ORM\Table(name="avatar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvatarRepository")
 */
class Avatar
{
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
     *
     * @ORM\Column(name="src", type="string", length=255)
     */
    private $src;

    /**
     * @var \DateTime
     * @ORM\Column(name="uploaded_at", type="datetime")
     */
    private $uploadedAt;

    /**
     * @Assert\Image(groups={"upload"})
     *
     * @Assert\NotBlank(groups={"upload"})
     */
    private $uploadedFile;

    public function __construct()
    {
        $this->uploadedAt = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId():?int
    {
        return $this->id;
    }

    /**
     * Set src.
     *
     * @param string $src
     *
     * @return Avatar
     */
    public function setSrc(String $src):Avatar
    {
        $this->src = $src;
        return $this;
    }

    /**
     * Get src.
     *
     * @return string
     */
    public function getSrc():?String
    {
        return $this->src;
    }

    /**
     * Set uploadedAt.
     *
     * @param \DateTime $uploadedAt
     *
     * @return Avatar
     */
    public function setUploadedAt(\DateTime $uploadedAt):Avatar
    {
        $this->uploadedAt = $uploadedAt;
        return $this;
    }

    /**
     * Get uploadedAt.
     *
     * @return \DateTime
     */
    public function getUploadedAt(): ?\DateTime
    {
        return $this->uploadedAt;
    }

    /**
     * @param mixed $uploadedFile
     *
     * @return Avatar
     */
    public function setUploadedFile($uploadedFile):Avatar
    {
        $this->uploadedFile = $uploadedFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }
}
