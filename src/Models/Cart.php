<?php

namespace Src\Models;

use Src\Interfaces\MoneyInterface;

class Cart
{


    private int $id;
    private string $name;
    private MoneyInterface $price;
    private float $vatRate;
    private int $quantity;
    private int $available;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(int $id, string $name, MoneyInterface $price, float $vatRate,  int $quantity, int $available, string $createdAt, string $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->vatRate = $vatRate;
        $this->quantity = $quantity;
        $this->available = $available;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
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


    public function getAvailable(): int
    {
        return $this->available;
    }


    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }


    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }


}