<?php

namespace App\Services;

use App\Models\LinkModel;
use App\Models\SubscriberModel;
use App\Services\Interfaces\IMailer;

class MailService implements IMailer
{

    public static function handle(SubscriberModel $subscriber, LinkModel $link)
    {
        $price = $link->getProductPrice();
        $url = $link->getUrl();
        $id = $link->getId();

        static::mail(
            $subscriber->getEmail(),
            "Price of product #$id has been updated",
            "Your product`s price has been updated. Current price is $price. Check it by URL: $url",
        );
    }

    public static function mail(string $email, string $subject, string $message): void
    {
        mail($email, $subject, $message);
    }
}
