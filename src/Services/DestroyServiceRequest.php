<?php



namespace Src\Services;


use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;

class DestroyServiceRequest implements ProductInterface
{
    private int $id;
    private string $name;
    private int $available;
    private MoneyInterface $price;
    private float $vatRate;
    private string $image;
    private string $description;



    public function __construct(int $id, string $name, string $image, int $available, MoneyInterface $price, float $vatRate, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->available = $available;
        $this->price = $price;
        $this->vatRate = $vatRate;
        $this->image = $image;
        $this->description = $description;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
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


    public function getDescription(): string
    {
        return $this->description;
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


    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
