<?php

namespace App\Controllers\api;

use App\Controllers\IndexController;
use App\Enums\StatusesEnum;
use App\Http\Response;
use App\Services\SubscribeService;

class SubscribeController extends IndexController
{
    public function indexAction(): Response
    {
        try {
            SubscribeService::handle($this->request->getData());
        } catch (\Exception $e) {
            return new Response(StatusesEnum::ERROR, $e->getMessage());
        }
        return new Response(StatusesEnum::OK, 'You have successfully subscribed to product`s updates');
    }
}