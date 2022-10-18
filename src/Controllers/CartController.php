<?php


namespace Src\Controllers;


use Exception;
use Src\Requests\Cart\BuyCartRequest;
use Src\Requests\Cart\CreateCartRequest;
use Src\Services\Cart\AddToCartServiceRequest;
use Src\Services\Cart\CartService;
use Src\Services\Cart\CartServiceRequest;
use Src\Services\Cart\CartServiceRequestCollection;
use Src\Services\MoneyServiceRequest;
use Src\Services\RemoveFromCartServiceRequest;


class CartController
{
    private CartService $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();

    }

    /**
     * @throws \Exception
     */
    public function index(): void
    {
        try {
            $productsArray = $this->cartService->getProducts();
        } catch (Exception $e) {
            throw new Exception('Unable to obtain cart products', 0, $e);
        }

        $products = [];
        foreach ($productsArray as $product) {
            $products[] = [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "price" => $product->getPrice()->getPrice(),
                "vatRate" => $product->getVatRate(),
                "quantity" => $product->getQuantity(),
                "available" => $product->getAvailable(),
                "createdAt" => $product->getCreatedAt(),
                "updatedAt" => $product->getUpdatedAt(),
            ];

        }
        echo json_encode($products);
    }

    /**
     * @throws \Exception
     */
    public function store(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $validate = new CreateCartRequest((array)$product);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            $newCartProduct = new AddToCartServiceRequest(
                $product->id,
                $product->name,
                $product->available,
                new MoneyServiceRequest((int)$product->price, (float)$product->vatRate),
                $product->vatRate,
                $product->quantity
            );

            try {
                $this->cartService->addProduct($newCartProduct);
            } catch (Exception $e) {
                throw new Exception('Unable to add cart product', 0, $e);
            }
        } else {
            echo json_encode($errors);
        }
    }

    /**
     * @throws \Exception
     */
    public function destroy(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $validate = new CreateCartRequest((array)$product);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            $removedProduct = new RemoveFromCartServiceRequest(
                $product->id,
                $product->name,
                $product->available,
                new MoneyServiceRequest((int)$product->price, (float)$product->vatRate),
                $product->vatRate,
                $product->quantity
            );

            try {
                $this->cartService->removeProduct($removedProduct);
            } catch (Exception $e) {
                throw new Exception('Unable to remove cart product', 0, $e);
            }
        } else {
            echo json_encode($errors);
        }
    }


    /**
     * @throws \Exception
     */
    public function subtotal(): void
    {
        try {
            $this->cartService->getSubtotal()->getPrice();
        } catch (Exception $e) {
            throw new Exception('Unable to get subtotal in cart products', 0, $e);
        }
    }

    /**
     * @throws \Exception
     */
    public
    function vatAmount(): void
    {
        try {
            $this->cartService->getVatAmount()->getVatPrice();
        } catch (Exception $e) {
            throw new Exception('Unable to get vatAmount in cart products', 0, $e);
        }
    }

    /**
     * @throws \Exception
     */
    public
    function total(): void
    {
        try {
            $this->cartService->getSubtotal()->getPrice() + $this->cartService->getTotal()->getPrice();
        } catch (Exception $e) {
            throw new Exception('Unable to get total in cart products', 0, $e);
        }
    }


    /**
     * @throws \Exception
     */
    public
    function buy(): void
    {
        $productInput = json_decode(file_get_contents("php://input"));

        $validate = new BuyCartRequest((array)$productInput);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            $products = [];
            foreach ($productInput as $product) {
                $products[] = new CartServiceRequest(
                    $product->id,
                    $product->name,
                    $product->available,
                    new MoneyServiceRequest((int)$product->price, (float)$product->vatRate),
                    $product->vatRate,
                    $product->quantity
                );
            }
            $cartProductsCollection = new CartServiceRequestCollection($products);

            try {
                $this->cartService->buy($cartProductsCollection);
            } catch (Exception $e) {
                throw new Exception('Unable to buy products in cart', 0, $e);
            }
        } else {
            echo json_encode($errors);
        }
    }
}
