<?php

namespace App\Helpers;

class FetchDataHelper
{
    private string $apiURL = "https://www.olx.ua/api/v1/targeting/data/?page=ad&params%5Bad_id%5D=";

    public function fetchInfoAboutProduct($url): array|false
    {
        $data = $this->fetchData($url);
        $productId = $this->getProductIdFromHtml($data);
        if ($productId) {
            return [
                'product_id' => $productId,
                'product_price' => $this->fetchProductPrice($productId),
                'product_url' => $url,
            ];
        }
        return false;
    }

    public function fetchProductPrice(int $productId): float
    {
        return (float)json_decode(
            $this->fetchData($this->apiURL . $productId), true
        )['data']['targeting']['ad_price'];
    }

    private function getProductIdFromHtml(string $data): int|bool
    {
        $pattern = '/"sku"\s*:\s*"([^"]*)"/';
        if (preg_match($pattern, $data, $matches)) {
            return (int)$matches[1];
        } else {
            return false;
        }
    }

    private function fetchData(string $url): string
    {
        return file_get_contents($url);
    }
}