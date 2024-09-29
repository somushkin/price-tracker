<?php

namespace App\Models;

class LinkModel extends AbstractModel
{
    public static string $table = 'links';

    private ?string $url = null;
    private ?float $product_price = null;
    private ?int $product_id = null;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getProductPrice(): ?float
    {
        return (float)$this->product_price;
    }

    public function getProductId(): ?int
    {
        return (int)$this->product_id;
    }

    public function setProductId(int $id): void
    {
        $this->modifiedFields['product_id'] = $id;
        $this->product_id = $id;
    }

    public function setUrl(string $url): void
    {
        $this->modifiedFields['url'] = $url;
        $this->url = $url;
    }

    public function setProductPrice($price): void
    {
        $this->modifiedFields['product_price'] = (float)$price;
        $this->product_price = $price;
    }
}