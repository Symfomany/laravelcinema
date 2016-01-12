<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setUser('symfony');
        $comment->setComment('To make a long story short. You can\'t go wrong by choosing Symfony!');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('David');
        $comment->setComment('To make a long story short. Make sure that you make the right selection!');
        $comment->setBlog($manager->merge($this->getReference('blog-1')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Donec dui enim, facilisis id sollicitudin sed, ullamcorper id lacus. Mauris eros felis, tincidunt elementum iaculis eu, iaculis sit amet sapien.');
        $comment->setBlog($manager->merge($this->getReference('blog-2')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('Etiam eget diam pretium, auctor neque sit amet, pulvinar nibh?');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 06:15:20"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Name your stakes.');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 06:18:35"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('If I win, you give me ice cream.');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 06:22:53"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Ice Cream?');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 06:25:15"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('Yes! Chocolate, with sprinkles, and whip cream...');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 06:46:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('And if I win?');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 10:22:46"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('I still get ice cream!');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-23 11:08:08"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Dade');
        $comment->setComment('Everyone wins!');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-24 18:56:01"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Kate');
        $comment->setComment('Deal!');
        $comment->setBlog($manager->merge($this->getReference('blog-3')));
        $comment->setCreated(new \DateTime("2011-07-25 22:28:42"));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Stanley');
        $comment->setComment('It\'s not gonna end like this.');
        $comment->setBlog($manager->merge($this->getReference('blog-4')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Gabriel');
        $comment->setComment('Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.');
        $comment->setBlog($manager->merge($this->getReference('blog-4')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Mile');
        $comment->setComment('Doesn\'t Bill Gates have something like that?');
        $comment->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setUser('Gary');
        $comment->setComment('Bill Who?');
        $comment->setBlog($manager->merge($this->getReference('blog-5')));
        $manager->persist($comment);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
