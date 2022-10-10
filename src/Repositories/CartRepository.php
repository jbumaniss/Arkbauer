<?php




namespace Src\Repositories;



use Src\Interfaces\ProductInterface;
use Src\Models\Cart;
use Src\Services\Cart\CartServiceRequestCollection;
use Src\Services\MoneyServiceRequest;


class CartRepository extends Database
{

    public function get()
    {
        $sql = "SELECT * FROM cart";
        $stmt = $this->connect()->query($sql);
        $res = $stmt->fetchAll();

        $products = [];

        foreach ($res as $product){

            $products[] = new Cart(
                $product['product_id'],
                $product['name'],
                new MoneyServiceRequest($product['price'], $product['vatRate']),
                $product['vatRate'],
                $product['quantity'],
                $product['available'],
                $product['createdAt'],
                $product['updatedAt'],
            );
        }

        return $products;
    }


    public function addOrRemove(ProductInterface $product)
    {
        $sql = "SELECT * FROM cart WHERE product_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getId()
        ]);

        if ($stmt->rowCount() != 0){
            $sql = "UPDATE cart SET quantity=? WHERE product_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                $product->getQuantity(),
                $product->getId()
            ]);

            $sql = "UPDATE products SET quantity=? WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                $product->getQuantity(),
                $product->getId()
            ]);

        }else{
            $sql = "INSERT INTO cart(product_id, name, vatRate, vatPrice, price, euro, cents, available, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                $product->getId(),
                $product->getName(),
                $product->getVatRate(),
                $product->getPrice()->getVatPrice(),
                $product->getPrice()->getPrice(),
                $product->getPrice()->getEuros(),
                $product->getPrice()->getCents(),
                $product->getAvailable(),
                $product->getQuantity()
            ]);

            $sql = "UPDATE products SET quantity=? WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                $product->getQuantity(),
                $product->getId()
            ]);
        }
    }


    public function moneyCount()
    {
        $subtotal = 0;
        $vatAmount = 0;

        $sql = "SELECT * FROM cart";
        $stmt = $this->connect()->query($sql);
        $products = $stmt->fetchAll();

        foreach ($products as $product){

            if ($product['quantity'] > 0){
                $subtotal += $product['price'];
                $subtotal += $product['vatPrice'];
            }
        }

        return new MoneyServiceRequest($subtotal, $vatAmount);
    }

    public function buyCart(CartServiceRequestCollection $cartServiceRequestCollection)
    {
        $products = $cartServiceRequestCollection->getProducts();

        foreach ($products as $product)
        {
            if(($product->getAvailable() - $product->getQuantity()) > 0){
                $sql = "UPDATE products SET available=? , quantity=? WHERE id=?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([
                    ($product->getAvailable() - $product->getQuantity()),
                    0,
                    $product->getId()]);

                $sql = "TRUNCATE TABLE cart";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();


            }
        }
    }

}
