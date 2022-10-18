<?php


namespace Src\Services\Stock;

use Src\Interfaces\ProductInterface;
use Src\Interfaces\StockInterface;
use Src\Repositories\StockRepository;

class StockService implements StockInterface
{

    private StockRepository $stockRepository;

    public function __construct()
    {

        $this->stockRepository = new StockRepository();
    }


    public function getProducts(): array
    {
        return $this->stockRepository->showProducts();
    }


    public function addProduct(ProductInterface $product): self
    {
        $this->stockRepository->saveProduct($product);
        return $this;
    }


    public function updateProduct(ProductInterface $product): self
    {
        $this->stockRepository->updateProduct($product);
        return $this;
    }


    public function removeProduct(ProductInterface $product): self
    {
        $this->stockRepository->destroyProduct($product);
        return $this;
    }
}
