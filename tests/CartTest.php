<?php


namespace Tests;


use PHPUnit\Framework\TestCase;
use Src\Services\Cart\AddToCartServiceRequest;
use Src\Services\Cart\CartService;
use Src\Services\MoneyServiceRequest;
use Src\Services\RemoveFromCartServiceRequest;

class CartTest extends TestCase
{


    public function testGetCart()
    {
        $cartService = new CartService();
        $result = $cartService->getProducts();
        $this->assertIsArray($result);
    }

    public function testAddCart()
    {
        $stockService = new CartService();
        $result = $stockService
            ->addProduct(new AddToCartServiceRequest(
                '99', 'printer', 'google.com/image', 213, new MoneyServiceRequest(999.9, 21.1), 213,'lorem ipsum', 0
            ));

        $this->assertInstanceOf(CartService::class, $result);
    }

    public function testRemoveCart()
    {
        $stockService = new CartService();
        $result = $stockService
            ->removeProduct(new RemoveFromCartServiceRequest(
                '99', 'printer', 'google.com/image', 21.1, new MoneyServiceRequest(999.9, 21.1), 213,'lorem ipsum', 0, '2022-22-31','2022-22-31'
            ));


        $this->assertInstanceOf(CartService::class, $result);
    }

    public function testGetSubtotal()
    {
        $stockService = new CartService();
        $result = $stockService->getSubtotal();
        $this->assertInstanceOf(MoneyServiceRequest::class, $result);
    }

    public function testGetVatAmount()
    {
        $stockService = new CartService();
        $result = $stockService->getVatAmount();
        $this->assertInstanceOf(MoneyServiceRequest::class, $result);
    }

    public function testGetTotal()
    {
        $stockService = new CartService();
        $result = $stockService->getVatAmount();
        $this->assertInstanceOf(MoneyServiceRequest::class, $result);
    }

}