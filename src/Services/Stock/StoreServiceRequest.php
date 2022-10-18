<?php


namespace Src\Services\Stock;


use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;

class StoreServiceRequest implements ProductInterface
{


    private string $name;
    private int $available;
    private MoneyInterface $price;
    private float $vatRate;
    private string $image;
    private string $description;


    public function __construct(string $name, string $image, int $available, MoneyInterface $price, float $vatRate, string $description)
    {
        $this->name = $name;
        $this->available = $available;
        $this->price = $price;
        $this->vatRate = $vatRate;
        $this->image = $image;
        $this->description = $description;
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

    public function getImage(): string
    {
        return $this->image;
    }


    public function getDescription(): string
    {
        return $this->description;
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


    public function setPrice(MoneyInterface $money): self
    {
        $this->money = $money;
        return $this;
    }


    public function setVatRate(float $vatRate): self
    {
        $this->vatRate = $vatRate;
        return $this;
    }


    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }


    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
}
