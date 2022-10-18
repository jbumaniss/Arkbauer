<?php


namespace Src\Controllers;


use Exception;
use Src\Requests\Stock\CreateStockRequest;
use Src\Requests\Stock\DestroyStockRequest;
use Src\Requests\Stock\UpdateStockRequest;
use Src\Services\DestroyServiceRequest;
use Src\Services\MoneyServiceRequest;
use Src\Services\Stock\StockService;
use Src\Services\Stock\StoreServiceRequest;
use Src\Services\Stock\UpdateServiceRequest;

class StockController
{
    private StockService $stockService;

    public function __construct()
    {
        $this->stockService = new StockService();
    }


    /**
     * @throws Exception
     */
    public function index(): void
    {
        try {
            $productsArray = $this->stockService->getProducts();
        } catch (Exception $e) {
            throw new Exception('Unable to obtain products', 0, $e);
        }

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


    /**
     * @throws Exception
     */
    public function store(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $validate = new CreateStockRequest((array)$product);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            try {
                $newProduct = new StoreServiceRequest(
                    $product->productName,
                    $product->productImage,
                    $product->productAvailable,
                    new MoneyServiceRequest((int)$product->productPrice, (float)$product->productVatRate),
                    $product->productVatRate,
                    $product->productDescription
                );

                $this->stockService->addProduct($newProduct);
            } catch (Exception $e) {
                throw new Exception('Unable to store product', 0, $e);
            }
        }else{
            echo json_encode($errors);
        }
    }


    /**
     * @throws Exception
     */
    public function update(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $validate = new UpdateStockRequest((array)$product);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            try {
                $updatedProduct = new UpdateServiceRequest(
                    $product->id,
                    $product->name,
                    $product->available,
                    new MoneyServiceRequest($product->price, $product->vatRate),
                    $product->vatRate,
                    $product->quantity,
                    $product->description
                );

                $this->stockService->updateProduct($updatedProduct);
            } catch (Exception $e) {
                throw new Exception('Unable to update product', 0, $e);
            }
        }else{
            echo json_encode($errors);
        }
    }


    /**
     * @throws Exception
     */
    public function destroy(): void
    {
        $product = json_decode(file_get_contents("php://input"));

        $validate = new DestroyStockRequest((array)$product);
        $errors = $validate->validateForm();

        if (empty($errors)) {
            try {
                $destroyedProduct = new DestroyServiceRequest(
                    $product->id,
                    $product->name,
                    $product->image,
                    $product->available,
                    new MoneyServiceRequest($product->price, $product->vatRate),
                    $product->vatRate,
                    $product->description
                );
                $this->stockService->removeProduct($destroyedProduct);
            } catch (Exception $e) {
                throw new Exception('Unable to destroy product', 0, $e);
            }
        }else{
            echo json_encode($errors);
        }
    }
}
