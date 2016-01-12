<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/admin/blogs/{id}/delete")
     * @Security("is_granted('DELETE_POST', blog)")
     */
    public function deleteBlogAction(Blog $blog)
    {
        return new Response('Granted to delete post!');
    }

    /**
     * @Route("/admin/super-secret")
     * @Security("user.getUsername() == 'foobar'")
     */
    public function secureAction()
    {
        return new Response('This is secured!');
    }

    /**
     * @Route("/login", name="app_login")
     * @Method("GET")
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }

    /**
     * @Route("/admin/auth", name="app_login_check")
     * @Method("POST")
     */
    public function loginCheckAction()
    {
        throw new \Exception('This should not be reached!');
    }

    /**
     * @Route("/admin/logout", name="app_logout")
     * @Method("GET")
     */
    public function logoutAction()
    {
        throw new \Exception('This should not be reached!');
    }
}
