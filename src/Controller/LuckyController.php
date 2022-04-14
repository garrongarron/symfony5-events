<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    /**
     * @Route("/lucky/number", name="lucky_number")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    /**
     * @Route("/lucky/sender", name="lucky_sender")
     */
    public function sender()
    {
        $email = (new Email())
            ->from('support@example.com')
            ->to('juan@example.com')
            ->subject('IMPORTANT')
            ->text('Content...')
            ->html('<h1>Content...</h1>');

        $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);

        $mailer = new Mailer($transport); 
        $mailer->send($email);
        echo 'ok';exit();
    }
}