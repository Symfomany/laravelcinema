<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function createCommentFormAction(Blog $blog)
    {
        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createCommentForm($comment, $blog);

        return $this->render('comment/_form.html.twig', [
            'comment' => $comment,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/comments/{id}/new", name="app_add_comment", requirements={ "id" = "\d+" })
     * @Method("GET|POST")
     */
    public function newAction(Request $request, Blog $blog)
    {
        $comment = new Comment();
        $comment->setBlog($blog);

        $form = $this->createCommentForm($comment, $blog);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('app_blog_show', ['id' => $blog->getId()]).'#comment-'.$comment->getId());
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form'    => $form->createView(),
        ]);
    }

    private function createCommentForm(Comment $comment, Blog $blog)
    {
        return $this->createForm('app_comment', $comment, [
            'action' => $this->generateUrl('app_add_comment', [
                'id' => $blog->getId(),
            ]),
        ]);
    }
}
