<?php

declare(strict_types=1);

namespace App\Product\Application\Command;

use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Product;

class CreateNewProduct
{

    /**
     * @var string
     */
    private string $name;
    private string $description;
    private int $price;

    public function __construct(string $name, string $description, int $price)
    {
        //TODO: move validations to domain validation
        if (strlen($name) > Product::NAME_MAX_LENGTH || strlen($name) < Product::NAME_MIN_LENGTH) {
            throw ProductException::wrongProductName();
        }

        if (strlen($description) > Product::DESCRIPTION_MAX_LENGTH || strlen($description) < Product::DESCRIPTION_MIN_LENGTH) {
            throw ProductException::wrongProductDescription();
        }

        if ($price === 0 || $price > 1000000) {
            throw ProductException::wrongProductPrice();
        }

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }

}