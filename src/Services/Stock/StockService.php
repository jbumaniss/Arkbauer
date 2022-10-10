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
        return $this->stockRepository->show();
    }

    public function addProduct(ProductInterface $product): self
    {
        $this->stockRepository->save($product);
        return $this;
    }

    public function updateProduct(ProductInterface $product): self
    {
        $this->stockRepository->updateProduct($product);
        return $this;
    }

    public function removeProduct(ProductInterface $product): self
    {
        $this->stockRepository->destroy($product);
        return $this;
    }

}
