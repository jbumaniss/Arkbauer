<?php


namespace Src\Repositories;



use Src\Interfaces\ProductInterface;
use Src\Models\Product;
use Src\Services\MoneyServiceRequest;


class StockRepository extends Database
{
    public function showProducts(): array
    {
        $products = [];

        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->query($sql);
        $res = $stmt->fetchAll();

        foreach ($res as $product) {
            $products[] = new Product(
                $product['id'],
                $product['name'],
                $product['image'],
                $product['vatRate'],
                new MoneyServiceRequest($product['vatPrice'], $product['vatRate']),
                $product['available'],
                $product['description'],
                $product['quantity'],
                $product['createdAt'],
                $product['updatedAt'],
            );
        }
        return $products;
    }


    public function saveProduct(ProductInterface $product): void
    {
        $defaultOrderQuantity = 0;

        $sql = "INSERT INTO products(name, image, vatrate, vatPrice, price, euro, cents, available, description, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getName(),
            $product->getImage(),
            $product->getVatRate(),
            $product->getPrice()->getVatRate(),
            $product->getPrice()->getPrice(),
            $product->getPrice()->getEuros(),
            $product->getPrice()->getCents(),
            $product->getAvailable(),
            $product->getDescription(),
            $defaultOrderQuantity
        ]);
    }


    public function updateProduct(ProductInterface $updateProductRequest): void
    {
        $sql = "UPDATE products SET name=?, available=?, description=?   WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $updateProductRequest->getName(),
            $updateProductRequest->getAvailable(),
            $updateProductRequest->getDescription(),
            $updateProductRequest->getId()
        ]);
    }


    public function destroyProduct(ProductInterface $product): void
    {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getId()
        ]);
    }
}
