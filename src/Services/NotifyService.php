<?php

namespace App\Services;

use App\Helpers\FetchDataHelper;
use App\Helpers\PriceHelper;
use App\Models\LinkModel;
use App\Models\SubscriberModel;
use App\Repositories\LinkRepository;
use App\Repositories\LinkSubscriberRepository;

class NotifyService
{
    public static function handle()
    {
        $links = LinkRepository::all();

        /**@var \App\Models\LinkModel $link * */
        foreach ($links as $link) {
            $fetchHelper = new FetchDataHelper();
            $newPrice = $fetchHelper->fetchProductPrice($link->getProductId());
            if (!PriceHelper::equal($newPrice, $link->getProductPrice())) {
                $link->setProductPrice($newPrice);
                $link->update();
                $subscribers = LinkSubscriberRepository::getProductSubscribers($link);
                foreach ($subscribers as $subscriber) {
                    static::notify($subscriber, $link);
                }
            }
        }
    }

    private static function notify(SubscriberModel $subscriberModel, LinkModel $linkModel)
    {
        MailService::handle($subscriberModel, $linkModel);
    }
}