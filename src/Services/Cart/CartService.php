<?php



namespace Src\Services\Cart;




use Src\Interfaces\CartInterface;
use Src\Interfaces\MoneyInterface;
use Src\Interfaces\ProductInterface;
use Src\Repositories\CartRepository;


class CartService implements CartInterface
{
    private CartRepository $cartRepository;


    public function __construct()
    {

        $this->cartRepository = new CartRepository();

    }

    public function addProduct(ProductInterface $product): self
    {
        $this->cartRepository->addOrRemove($product);
        return $this;
    }

    public function removeProduct(ProductInterface $product):self
    {
        $this->cartRepository->addOrRemove($product);
        return $this;
    }

    public function getProducts(): array
    {
        return $this->cartRepository->get();
    }

    public function getSubtotal(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    public function getVatAmount(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    public function getTotal(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    public function buy(CartServiceRequestCollection $cartServiceRequestCollection): self
    {
        $this->cartRepository->buyCart($cartServiceRequestCollection);
        return $this;
    }
}
