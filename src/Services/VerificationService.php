<?php

namespace App\Services;

use App\Models\SubscriberModel;

class VerificationService
{
    public static function handle(SubscriberModel $subscriber): void
    {
        $verificationCode = static::makeVerificationCode($subscriber);
        $subscriber->setVerificationCode($verificationCode);
        $subscriber->update();

        MailService::mail(
            $subscriber->getEmail(),
            'Email verification',
            'Your verification link: ' . static::makeVerificationUrl($verificationCode)
        );
        throw new \Exception('To subscribe, you first need to verify your email. The verification link has been sent to your email');
    }

    private static function makeVerificationCode(SubscriberModel $subscriber): string
    {
        return md5($subscriber->getEmail());
    }

    private static function makeVerificationUrl(string $code): string
    {
        return 'http://localhost/verification/' . $code;
    }
}