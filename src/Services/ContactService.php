<?php

namespace App\Services;

use App\Entity\Contact;
use Twig\Environment;

class ContactService {

  public function __construct(\Swift_Mailer $mailer, Environment $renderer) {
    $this->mailer = $mailer;
    $this->renderer = $renderer;
  }

  public function sendMessage(Contact $contact)
  {
    $message = (new \Swift_Message('Agence: ' . $contact->getProperty()->getTitle()))
      ->setFrom('noreply@server.com')
      ->setTo('contact@agence.fr')
      ->setReplyTo($contact->getMail())
      ->setBody($this->renderer->render(
        'emails/contact.html.twig', [
          'contact' => $contact
        ]
      ), 'text/html');

    $this->mailer->send($message);
  }
}