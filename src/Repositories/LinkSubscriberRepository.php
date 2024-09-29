<?php

namespace App\Repositories;

use App\Models\LinkModel;
use App\Models\LinkSubscriberModel;
use App\Models\SubscriberModel;

class LinkSubscriberRepository extends AbstractRepository
{
    public static string $model = LinkSubscriberModel::class;

    public static function isLinkSubscriberExists(LinkModel $linkModel, SubscriberModel $subscriberModel): bool
    {
        return (bool)count(static::where([
            'link_id' => $linkModel->getId(),
            'subscriber_id' => $subscriberModel->getId(),
        ]));
    }

    public static function getProductSubscribers(LinkModel $linkModel): array
    {
        $subscribers = [];
        $ls = static::where([
            'link_id' => $linkModel->getId(),
        ]);
        foreach ($ls as $item) {
            $subscribers[] = SubscriberRepository::find($item->subscriber_id);
        }
        return $subscribers;
    }
}