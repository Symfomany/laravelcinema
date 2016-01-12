<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/{id}", name="app_blog_show", requirements={ "id"="\d+" })
     * @Method("GET")
     */
    public function showAction(Blog $blog)
    {
        $comments = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Comment')
            ->getCommentsForBlog($blog->getId());

        return $this->render('blog/show.html.twig', array(
            'blog'      => $blog,
            'comments'  => $comments
        ));
    }
}
