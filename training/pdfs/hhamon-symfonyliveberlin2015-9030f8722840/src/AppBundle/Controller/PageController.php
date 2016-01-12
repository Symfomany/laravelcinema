<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Enquiry;
use AppBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blogs = $em->getRepository('AppBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('page/index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    /**
     * @Route("/about", name="app_about")
     * @Method("GET")
     */
    public function aboutAction()
    {
        return $this->render('page/about.html.twig');
    }

    /**
     * @Route("/contact", name="app_contact")
     * @Method("GET|POST")
     */
    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.contact_mailer')->sendContactNotification($enquiry);

            $this->get('session')
                ->getFlashBag()
                ->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirectToRoute('BloggerBlogBundle_contact');
        }

        return $this->render('page/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $tags = $em->getRepository('AppBundle:Blog')
                   ->getTags();

        $tagWeights = $em->getRepository('AppBundle:Blog')
                         ->getTagWeights($tags);

        $latestComments = $em->getRepository('AppBundle:Comment')
                             ->getLatestComments(Comment::MAX_LIMIT);

        return $this->render('page/_sidebar.html.twig', array(
            'latestComments'    => $latestComments,
            'tags'              => $tagWeights
        ));
    }

}
