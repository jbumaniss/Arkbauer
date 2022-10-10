<?php




namespace Src\Repositories;



use Src\Interfaces\ProductInterface;
use Src\Models\Product;
use Src\Services\MoneyServiceRequest;
use Src\Services\Stock\UpdateServiceRequest;

class StockRepository extends Database
{

    public function show(): array
    {
        $defaultOrderQuantity = 0;

        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->query($sql);
        $res = $stmt->fetchAll();

        $products = [];

        foreach ($res as $product){

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


    public function save(ProductInterface $product): void
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



    public function updateProduct(UpdateServiceRequest $updateProductRequest)
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

    public function destroy(ProductInterface $product)
    {
        $sql = "DELETE FROM products WHERE id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getId()
        ]);
    }
}
