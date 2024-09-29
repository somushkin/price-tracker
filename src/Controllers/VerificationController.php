<?php

namespace App\Controllers;

use App\Enums\StatusesEnum;
use App\Http\Response;
use App\Repositories\SubscriberRepository;

class VerificationController extends IndexController
{
    public function indexAction($arg)
    {
        try {
            $subscriber = SubscriberRepository::first(['verification_code' => $arg]);
            $subscriber->verify();
            $subscriber->update();
            return new Response(StatusesEnum::OK, 'Your email has been successfully verified.');
        } catch (\Exception $e) {
            return new Response(StatusesEnum::ERROR, $e->getMessage());
        }
    }
}