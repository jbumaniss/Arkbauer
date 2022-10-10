<?php




namespace Src\Services\Cart;


use Src\Interfaces\CartInterface;
use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;

class CartServiceRequestCollection implements CartInterface
{
    private array $products = [];
    private MoneyInterface $subtotal;
    private MoneyInterface $vatAmount;
    private MoneyInterface $total;

    public function __construct(array $products)
    {
        foreach ($products as $product){
            $this->addProduct($product);
        }

    }

    public function addProduct(ProductInterface $product): self
    {
        $this->products[] = $product;
        return $this;
    }

    public function removeProduct(ProductInterface $product): self
    {

        foreach ($this->products as $key => $prod){
            if ($prod->getId() == $product->getId()){
                unset($this->products[$key]);
            }
        }
        return $this;
    }

    public function getProducts(): array
    {
        return $this->products;
    }



    public function getSubtotal(): MoneyInterface
    {
        return $this->subtotal;
    }

    public function getVatAmount(): MoneyInterface
    {
        return $this->vatAmount;
    }

    public function getTotal(): MoneyInterface
    {
        return $this->total;
    }
}
