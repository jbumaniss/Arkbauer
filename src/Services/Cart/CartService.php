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

    /**
     * @throws \Exception
     */
    public function getProducts(): array
    {
        return $this->cartRepository->showCart();
    }

    /**
     * @throws \Exception
     */
    public function addProduct(ProductInterface $product): self
    {
        $this->cartRepository->addOrRemove($product);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function removeProduct(ProductInterface $product):self
    {
        $this->cartRepository->addOrRemove($product);
        return $this;
    }


    /**
     * @throws \Exception
     */
    public function getSubtotal(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    /**
     * @throws \Exception
     */
    public function getVatAmount(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    /**
     * @throws \Exception
     */
    public function getTotal(): MoneyInterface
    {
        return $this->cartRepository->moneyCount();
    }

    /**
     * @throws \Exception
     */
    public function buy(CartServiceRequestCollection $cartServiceRequestCollection): self
    {
        $this->cartRepository->buyCart($cartServiceRequestCollection);
        return $this;
    }
}
