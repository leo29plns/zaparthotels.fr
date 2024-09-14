<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestSmsController extends AbstractController
{
    #[Route('/test/sms', name: 'app_test_sms')]
    public function index(TexterInterface $texterInterface): Response
    {
        $sms = new SmsMessage(
            // the phone number to send the SMS message to
            '+33782805337',
            // the message
            'Coucouuuuuu Chiara',
            'ZAPART.FR'
        );

        $sentMessage = $texterInterface->send($sms);

        return new Response("OK");
    }
}
