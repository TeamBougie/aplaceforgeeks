<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 23/03/2017
 * Time: 20:44
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Post;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //todo ...
    }

    public function getOrder()
    {
        return 20;
    }
}