<?php


namespace Src\Controllers;


use Src\Services\DestroyServiceRequest;
use Src\Services\MoneyServiceRequest;
use Src\Services\Stock\StockService;
use Src\Services\Stock\StoreProductServiceRequest;
use Src\Services\Stock\UpdateProductRequest;

class StockController
{
    private StockService $stockService;

    public function __construct()
    {
        $this->stockService = new StockService();
    }

    public function products(): void
    {
        $productsArray = $this->stockService->getProducts();

        $products = [];

        foreach ($productsArray as $product) {


            $products[] = [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "available" => $product->getAvailable(),
                "price" => $product->getPrice()->getPrice(),
                "euro" => $product->getPrice()->getEuros(),
                "cents" => $product->getPrice()->getCents(),
                "vatRate" => $product->getVatRate(),
                "vatPrice" => $product->getPrice()->getVatPrice(),
                "image" => $product->getImage(),
                "quantity" => $product->getQuantity(),
                "description" => $product->getDescription(),
                "createdAt" => $product->getCreatedAt(),
                "updatedAt" => $product->getUpdatedAt(),
            ];

        }
        echo json_encode($products);
    }

    public function store():void
    {
        $product = json_decode(file_get_contents("php://input"));

        $this->stockService->addProduct(
            new StoreProductServiceRequest(
                $product->productName,
                $product->productImage,
                $product->productAvailable,
                new MoneyServiceRequest((int)$product->productPrice, (float)$product->productVatRate),
                $product->productVatRate,
                $product->productDescription
            )
        );
    }

    public function update(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $product = new UpdateProductRequest(
            $product->id,
            $product->name,
            $product->available,
            new MoneyServiceRequest($product->price, $product->vatRate),
            $product->vatRate,
            $product->quantity,
            $product->description
        );

        $this->stockService->updateProduct($product);

    }

    public function destroy(): void
    {

        $product = json_decode(file_get_contents("php://input"));
        $this->stockService->removeProduct(
            new DestroyServiceRequest(
                $product->id,
                $product->name,
                $product->image,
                $product->available,
                new MoneyServiceRequest($product->price, $product->vatRate),
                $product->vatRate,
                $product->description
            ));
    }
}
