<?php



namespace Tests;


use PHPUnit\Framework\TestCase;
use Src\Models\Product;
use Src\Services\MoneyServiceRequest;

class ProductTest extends TestCase
{

    public function testGetName()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->getName();
        $expected = "printer";
        $this->assertEquals($expected, $result);
    }

    public function testGetAvailable()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->getAvailable();
        $expected = 213;
        $this->assertEquals($expected, $result);
    }

    public function testGetPrice()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->getPrice()->getPrice();
        $expected = 999.9;
        $this->assertEquals($expected, $result);
    }

    public function testGetVatRate()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->getVatRate();
        $expected = 21.1;
        $this->assertEquals($expected, $result);
    }

    public function testSetName()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->setName("James");
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testSetAvailable()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->setAvailable(200);
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testSetPrice()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->setPrice(new MoneyServiceRequest(599.9, 21.1));
        $this->assertInstanceOf(Product::class, $result);
    }

    public function testSetVatRate()
    {
        $productService = new Product(99, 'printer','google.com/image',  21.1, new MoneyServiceRequest(999.9, 21.1) , 213,  'lorem ipsum',213,'2022-22-03', '2022-22-03');
        $result = $productService->setVatRate(15);
        $this->assertInstanceOf(Product::class, $result);
    }

}