<?php


namespace Src\Models;

class ProductCollection
{
    private array $products = [];

    public function __construct(array $products)
    {
        foreach ($products as $product){
            $this->addProduct($product);
        }

    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

}