<?php

namespace AppBundle\Mailer;

use Symfony\Component\Templating\EngineInterface;
use AppBundle\Entity\Enquiry;

class ContactMailer
{
    private $mailer;

    private $templating;

    private $toEmail;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $toEmail)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->toEmail = $toEmail;
    }

    public function sendContactNotification(Enquiry $enquiry)
    {
        $body = $this->templating
            ->render('page/contactEmail.txt.twig', [ 'enquiry' => $enquiry ]);

        $message = \Swift_Message::newInstance()
            ->setSubject('Contact enquiry from symblog')
            ->setFrom('enquiries@symblog.co.uk')
            ->setTo($this->toEmail)
            ->setBody($body);

        $this->mailer->send($message);
    }
}
