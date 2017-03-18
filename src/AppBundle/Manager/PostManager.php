<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 12/03/2017
 * Time: 22:11
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Post;

/**
 * PostManager.
 * Service gérant plusieurs actions concernant la gestion des Posts.
 */
class PostManager
{
    private $doctrineManager;

    /**
     * PostManager constructor.
     * @param $doctrineManager
     */
    public function __construct($doctrineManager)
    {
        $this->doctrineManager = $doctrineManager;
    }
    /**
     * @return Post
     */
    public function create()
    {
        return new Post();
    }

    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        if($post->getId() === null)
        {
            $this->doctrineManager->persist($post);
        }
        $this->doctrineManager->flush();
    }
    public function remove(Post $post)
    {
        $this->doctrineManager->remove($post);
        $this->doctrineManager->flush();
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id)
    {
        return $this->getRepository()->getPost($id);
    }
    /**
     * @return mixed
     */
    private function getRepository()
    {
        return $this->doctrineManager->getRepository(Post::class);
    }
}