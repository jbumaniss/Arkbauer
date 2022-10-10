<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Models\Product;
use Src\Services\DestroyServiceRequest;
use Src\Services\MoneyServiceRequest;
use Src\Services\Stock\StockService;
use Src\Services\Stock\StoreServiceRequest;
use Src\Services\Stock\UpdateServiceRequest;

class StockTest extends TestCase
{

    public function testGetStock()
    {
        $stockService = new StockService();
        $result = $stockService->getProducts();
        $this->assertIsArray($result);
    }

    public function testAddStock()
    {
        $stockService = new StockService();
        $result = $stockService
            ->addProduct(new StoreServiceRequest(
                'printer','google.com/image',   213, new MoneyServiceRequest(999.9, 21.1), 21.1,'lorem ipsum'
            ));
        $this->assertInstanceOf(StockService::class, $result);
    }

    public function testRemoveStock()
    {
        $stockService = new StockService();
        $result = $stockService
            ->removeProduct(new DestroyServiceRequest(
                99, 'printer', 'google.com/image', 213, new MoneyServiceRequest(999.9, 21.1), 21.1,'lorem ipsum'
            ));
        $this->assertInstanceOf(StockService::class, $result);
    }

    public function testUpdateAddStock()
    {
        $stockService = new StockService();
        $result = $stockService
            ->updateProduct(new UpdateServiceRequest(
                99, 'printer', 213,  new MoneyServiceRequest(999.9, 21.1),21.1, 0,'lorem ipsum'
            ));
        $this->assertInstanceOf(StockService::class, $result);
    }

}
