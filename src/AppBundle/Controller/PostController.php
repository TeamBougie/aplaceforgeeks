<?php
/**
 * Created by PhpStorm.
 * User: vivma
 * Date: 12/03/2017
 * Time: 22:28
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/post/new/", name="app_post_new", methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(PostType::class, $this->getPostManager()->create());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $post= $form->getData();
            $post->setAuthor($this->getUser());
            $this->getPostManager()->save($post);
            $this->addFlash('success', 'Votre Post a été crée !');
            $this->redirectToRoute('app_post_view',['id' => $post->getId()]);
        }
        return $this->render(':post:new.html.twig', ['form' => $form->createView()]);
    }
    /**
     * @Route("/post/{id}", name="app_post_view")
     */
    public function viewAction(Post $post)
    {
        if (!$post instanceof Post)
        {
            throw $this->createNotFoundException('La publication n\'existe pas !');
        }
        return $this->render(':post:view.html.twig',['post'=> $post]);
    }
    /**
     * @Route("/post/edit/{id}", name="app_post_edit")
     */
    public function editAction(Request $request)
    {
        $post = $this->getPostManager()->getPost($request->get('id'));
        if (!$post instanceof Post)
        {
            throw $this->createNotFoundException(sprintf('La tâche d\'id : %s n\'existe pas !', $request->get('id')));
        }
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getPostManager()->save($form->getData());
            $this->addFlash('success', 'Votre publication a bien été mise à jour !');
            return $this->redirectToRoute('fos_user_profile_show');
        }
        return $this->render(':post:edit.html.twig', ['form' => $form->createView(),'post' => $post]);
    }
    /**
     * @Route("/post/delete/{id}", name="app_post_delete")
     */
    public function deleteAction(Post $post)
    {
        if (!$post instanceof Post)
        {
            throw $this->createNotFoundException('La publication n\'existe pas !');
        }
        if($post->getAuthor()->getId() != $this->getUser()->getId())
        {
            $this->createAccessDeniedException();
        }
        $post->setStatus(Post::STATUS_CLOSED);
        $this->getPostManager()->save($post);
        $this->addFlash('success', 'Votre publication a bien été supprimée !');
        return $this->redirectToRoute('fos_user_profile_show');
    }
    private function getPostManager()
    {
        return $this->get('app.post_manager');
    }

}