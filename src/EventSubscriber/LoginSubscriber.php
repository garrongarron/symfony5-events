<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

class LoginSubscriber implements EventSubscriberInterface
{
    public function onLoginSuccessEvent(LoginSuccessEvent $event)
    {
        // ...
        // dd($event->getUser()->getEmail());

        $email = (new Email())
            ->from('support@example.com')
            ->to($event->getUser()->getEmail())
            ->subject('IMPORTANT')
            ->text('You have been logged')
            ->html('<h1>You have been logged</h1>');

        $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);

        $mailer = new Mailer($transport); 
        $mailer->send($email);
    }

    public static function getSubscribedEvents()
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccessEvent',
        ];
    }
}
