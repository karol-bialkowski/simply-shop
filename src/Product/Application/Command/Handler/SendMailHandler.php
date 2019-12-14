<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Handler;

use App\Product\Application\Command\SendMail;
use App\Product\Domain\Mail;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SendMailHandler implements MessageHandlerInterface
{

    public function __construct()
    {
        //TODO: inject provider to swift mailer
    }


    public function __invoke(SendMail $sendMail): void
    {
        $product = new Mail(
            $sendMail->getRecipment(),
            $sendMail->getTopic(),
            $sendMail->getContent()
        );

        //TODO: implement swift mailer

    }

}