<?php

namespace Src\Services\Stock;

class UpdateServiceRequestCollection
{
    private array $products = [];

    public function __construct(array $products)
    {
        foreach ($products as $product){
            $this->addProduct($product);
        }

    }

    public function addProduct(UpdateServiceRequest $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}