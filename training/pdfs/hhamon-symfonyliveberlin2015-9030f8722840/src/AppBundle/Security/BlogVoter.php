<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Blog;

class BlogVoter extends AbstractVoter
{
    protected function getSupportedClasses()
    {
        return [ Blog::class ];
    }

    protected function getSupportedAttributes()
    {
        return [ 'DELETE_POST' ];
    }

    protected function isGranted($attribute, $object, $user = null)
    {
        if (!$user instanceof UserInterface) {
            return false;
        }

        return 'foobar' === $user->getUsername();
    }
}