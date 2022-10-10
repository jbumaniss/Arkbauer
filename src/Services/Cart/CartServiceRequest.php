<?php



namespace Src\Services\Cart;



use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;
use Src\Services\MoneyServiceRequest;

class CartServiceRequest implements ProductInterface
{
    private int $id;
    private string $name;
    private int $available;
    private float $vatRate;
    private int $quantity;
    private MoneyServiceRequest $price;

    public function __construct(int $id, string $name, int $available, MoneyServiceRequest $price, float $vatRate, int $quantity)
    {

        $this->id = $id;
        $this->name = $name;
        $this->available = $available;
        $this->vatRate = $vatRate;
        $this->quantity = $quantity;
        $this->price = $price;
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



    public function getPrice(): MoneyServiceRequest
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



    public function setId(int $id): void
    {
        $this->id = $id;
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


    public function setPrice(MoneyInterface $price): self
    {
        $this->price = $price;
        return $this;
    }

}
