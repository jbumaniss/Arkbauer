<?php



namespace Src\Services;


use Src\Interfaces\MoneyInterface;

class MoneyServiceRequest implements MoneyInterface
{
    private int $euros;
    private int $cents;
    private float $price;
    private float $vatRate;
    private float $vatPrice;
    private float $total;


    public function __construct(float $price, float $vatRate)
    {
        $this->price = $price;
        $euroAndCents = explode('.',number_format($price, 2));
        $this->euros = $euroAndCents[0];
        $this->cents = $euroAndCents[1];
        $this->vatRate = $vatRate;
        $this->vatPrice = ($price /100) * $vatRate;

    }


    public function getEuros(): int
    {
        return $this->euros;
    }


    public function getCents(): int
    {
        return $this->cents;
    }


    public function getPrice(): float
    {
        return $this->price;
    }


    public function getVatRate(): float
    {
        return $this->vatRate;
    }


    public function getVatPrice(): float
    {
        return $this->vatPrice;
    }


    public function getTotal(): float
    {
        return $this->total;
    }


    public function setTotal(float $total): self
    {
        $this->total = $total;
        return $this;
    }

    public function setVatPrice(float $vatPrice): self
    {
        $this->vatPrice = $vatPrice;
        return $this;
    }


    public function setVatRate(float $vatRate): self
    {
        $this->vatRate = $vatRate;
        return $this;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }


    public function setEuros(int $euros): self
    {
        $this->euros = $euros;
        return $this;
    }


    public function setCents(int $cents): self
    {
        $this->cents = $cents;
        return $this;
    }
}
