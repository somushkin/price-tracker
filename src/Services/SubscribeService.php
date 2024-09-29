<?php

namespace App\Services;

use App\Helpers\FetchDataHelper;
use App\Models\LinkModel;
use App\Models\SubscriberModel;
use App\Models\LinkSubscriberModel;
use App\Repositories\LinkRepository;
use App\Repositories\SubscriberRepository;
use App\Repositories\LinkSubscriberRepository;

class SubscribeService
{
    public static function handle($data): void
    {
        $subscriberModel = SubscriberRepository::findByEmail($data['email']);
        extract($data);

        if (!$subscriberModel) {
            $subscriberModel = new SubscriberModel();
            $subscriberModel->setEmail($email);
            $subscriberModel->setIsVerified(false);
        }

        $subscriberModel->save();

        if ($subscriberModel->isVerified()) {
            static::subscribe($subscriberModel, $url);
        } else {
            VerificationService::handle($subscriberModel);
        }
    }

    private static function subscribe(SubscriberModel $subscriberModel, $url): void
    {
        $fetcher = new FetchDataHelper();
        $data = $fetcher->fetchInfoAboutProduct($url);

        $linkModel = LinkRepository::findByProductId($data['product_id']);

        if (!$linkModel) {
            $linkModel = new LinkModel();
            $linkModel->setProductId($data['product_id']);
            $linkModel->setProductPrice($data['product_price']);
            $linkModel->setUrl($data['product_url']);
            $linkModel->save();
        }

        if (!LinkSubscriberRepository::isLinkSubscriberExists($linkModel, $subscriberModel)) {
            $linkSubscriberModel = new LinkSubscriberModel([
                'link_id' => $linkModel->getId(),
                'subscriber_id' => $subscriberModel->getId(),
            ]);
            $linkSubscriberModel->save();
        }
    }
}