<?php

namespace Src\Services;

use Src\Interfaces\MoneyInterface;

class RemoveCartProductServiceRequest implements \Src\Interfaces\ProductInterface
{

    private int $id;
    private string $name;
    private int $available;
    private MoneyInterface $price;
    private float $vatRate;
    private int $quantity;


    public function __construct(int $id, string $name, int $available, MoneyInterface $price, float $vatRate, int $quantity)
    {
        $this->name = $name;
        $this->available = $available;
        $this->price = $price;
        $this->vatRate = $vatRate;
        $this->id = $id;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }



    public function getName(): string
    {
        return $this->name;
    }


    public function getAvailable(): int
    {
        return $this->available;
    }

    public function getPrice(): MoneyInterface
    {
        return $this->price;
    }


    public function getVatRate(): float
    {
        return $this->vatRate;
    }


    public function getQuantity(): int
    {
        return $this->quantity;
    }


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function setAvailable(int $available): self
    {
        $this->available = $available;
        return $this;
    }


    public function setPrice(MoneyInterface $price): self
    {
        $this->price = $price;
        return $this;
    }


    public function setVatRate(float $vatRate): self
    {
        $this->vatRate = $vatRate;
        return $this;
    }


    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}
