<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 19/03/2017
 * Time: 11:36
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country.
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="name", type="string", length=160)
     */
    private $name;

    /**
     * Country constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param $name
     */
    public function setName(String $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName():String
    {
        return $this->name;
    }
}