<?php


namespace Src\Models;


use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;

class Product implements ProductInterface
{
    private int $id;
    private string $name;
    private int $available;
    private MoneyInterface $price;
    private float $vatRate;
    private string $image;
    private string $createdAt;
    private string $updatedAt;
    private string $description;
    private int $quantity;

    public function __construct(int $id, string $name, string $image, float $vatRate, MoneyInterface $price,  int $available, string $description , int $quantity , string $createdAt, string $updatedAt)

    {

        $this->name = $name;
        $this->available = $available;
        $this->price = $price;
        $this->vatRate = $vatRate;
        $this->id = $id;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->description = $description;
        $this->quantity = $quantity;
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


    public function getId(): int
    {
        return $this->id;
    }


    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }



    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }


    public function getDescription(): string
    {
        return $this->description;
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


    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }


    public function setVatRate(float $vatRate): self
    {
        $this->vatRate = $vatRate;
        return $this;
    }


    public function setPrice(MoneyInterface $price): self
    {
        $this->price = $price;
        return $this;
    }


    public function setAvailable(int $available): self
    {
        $this->available = $available;
        return $this;
    }


    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }


    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }


    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}