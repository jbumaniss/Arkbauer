<?php



namespace Src\Controllers;



use Src\Services\Cart\AddToCartServiceRequest;
use Src\Services\Cart\CartService;
use Src\Services\Cart\CartServiceRequest;
use Src\Services\Cart\CartServiceRequestCollection;
use Src\Services\DestroyServiceRequest;
use Src\Services\MoneyServiceRequest;
use Src\Services\RemoveFromCartServiceRequest;


class CartController
{
    private CartService $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();

    }

    public function show(): void
    {
        $productsArray = $this->cartService->getProducts();

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

    public function add(): void
    {
        $product = json_decode(file_get_contents("php://input"));
        $this->cartService->addProduct(
            new AddToCartServiceRequest(
                $product->id,
                $product->name,
                $product->available,
                new MoneyServiceRequest((int)$product->price, (float)$product->vatRate),
                $product->vatRate,
                $product->quantity
            )
        );
    }

    public function remove(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $this->cartService->removeProduct(
            new RemoveFromCartServiceRequest(
                $product->id,
                $product->name,
                $product->available,
                new MoneyServiceRequest((int)$product->price, (float)$product->vatRate),
                $product->vatRate,
                $product->quantity
            )
        );
    }

    public function destroy(): void
    {
        $product = json_decode(file_get_contents("php://input"));
        $this->cartService->removeProduct(
            new DestroyServiceRequest(
                $product->id,
                $product->name,
                $product->image,
                $product->available,
                new MoneyServiceRequest($product->price, $product->vatRate),
                $product->vatRate,
                $product->description
            )
        );
    }

    public function subtotal(): void
    {
       $this->cartService->getSubtotal()->getPrice();
    }

    public function vatAmount(): void
    {
        $this->cartService->getVatAmount()->getVatPrice();
    }

    public function total(): void
    {
        $this->cartService->getSubtotal()->getPrice() + $this->cartService->getTotal()->getPrice();

    }


    public function buy():void
    {
        $productInput = json_decode(file_get_contents("php://input"));
        $products = [];

        foreach ($productInput as $product){

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
        $this->cartService->buy($cartProductsCollection);
    }
}
