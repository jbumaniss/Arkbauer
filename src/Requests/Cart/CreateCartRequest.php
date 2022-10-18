<?php


namespace Src\Requests\Cart;

class CreateCartRequest
{
    private array $data;
    private array $errors = [];
    private static array $fields = [
        "id",
        "name",
        "available",
        "price",
        "vatRate",
        "quantity"
    ];


    public function __construct(array $product)
    {
        $this->data = $product;
    }

    public function validateForm(): array
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                $this->setError($field, 'is not present in data');
                return $this->errors;
            }
        }

        $this->validateId();
        $this->validateName();
        $this->validateAvailable();
        $this->validatePrice();
        $this->validateVatRate();
        $this->validateQuantity();

        return $this->errors;
    }

    private function validateId(): void
    {
        $name = 'id';
        $val = trim($this->data[$name]);

        if (empty($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->numerical($val)) {
                $this->setError($name, "product {$name} must be numeric");
            }
        }
    }


    private function validateName(): void
    {
        $name = 'name';
        $val = trim($this->data[$name]);

        if (empty($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->alphaNumerical($val)) {
                $this->setError($name, "product {$name} must be 3-250 chars & alphanumeric");
            }
        }
    }

    private function validateAvailable(): void
    {
        $name = 'available';
        $val = trim($this->data[$name]);

        if (!is_numeric($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->numerical($val)) {
                $this->setError($name, "product {$name} must be numeric");
            }
        }
    }

    private function validatePrice(): void
    {
        $name = 'price';
        $val = trim($this->data[$name]);

        if (!is_numeric($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->numerical($val)) {
                $this->setError($name, "product {$name} must be numeric");
            }
        }
    }

    private function validateVatRate(): void
    {
        $name = 'vatRate';
        $val = trim($this->data[$name]);

        if (!is_numeric($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->numerical($val)) {
                $this->setError($name, "product {$name} must be numeric");
            }
        }
    }

    private function validateQuantity(): void
    {
        $name = 'quantity';
        $val = trim($this->data[$name]);

        if (!is_numeric($val)) {
            $this->setError($name, "{$name} cannot be empty");
        } else {
            if (!$this->numerical($val)) {
                $this->setError($name, "product {$name} must be numeric");
            }
        }
    }


    private function numerical($val): bool
    {
        if (is_numeric($val)) {
            return true;
        } else {
            return false;
        }
    }

    private function alphaNumerical($val): bool
    {
        if (preg_match('/^[a-zA-Z0-9]{3,250}$/', $val)) {
            return true;
        } else {
            return false;
        }
    }

    private function setError($key, $message): void
    {
        $this->errors[$key] = $message;
    }
}
