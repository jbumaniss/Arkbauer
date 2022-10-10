<?php




namespace Tests;


use PHPUnit\Framework\TestCase;
use Src\Services\MoneyServiceRequest;


class MoneyTest extends TestCase
{

    public function testGetEuros()
    {
        $moneyService = new MoneyServiceRequest(3.99,21.1);
        $result = $moneyService->getEuros();
        $expected = 3;
        $this->assertEquals($expected, $result);
    }

    public function testGetCents()
    {
        $moneyService = new MoneyServiceRequest(3.99,21.1);
        $result = $moneyService->getCents();
        $expected = 99;
        $this->assertEquals($expected, $result);
    }

    public function testSetEuros()
    {
        $moneyService = new MoneyServiceRequest(3.99,21.1);
        $result = $moneyService->setEuros(4);
        $this->assertInstanceOf(MoneyServiceRequest::class, $result);
    }

    public function testSetCents()
    {
        $moneyService = new MoneyServiceRequest(3.99,21.1);
        $result = $moneyService->setEuros(4);
        $this->assertInstanceOf(MoneyServiceRequest::class, $result);
    }

}