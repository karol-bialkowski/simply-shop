<?php

declare(strict_types=1);

namespace App\Product\Application\Command;

use App\Product\Domain\Exception\ProductException;
use App\Product\Domain\Product;
use Money\Currency;
use Money\Money;

class CreateNewProduct
{

    /**
     * @var string
     */
    private string $name;
    private string $description;
    private Money $price;

    public function __construct(string $name, string $description, Money $price)
    {
        //TODO: move validations to domain validation
        if (strlen($name) > Product::NAME_MAX_LENGTH || strlen($name) < Product::NAME_MIN_LENGTH) {
            throw ProductException::wrongProductName();
        }

        if (strlen($description) > Product::DESCRIPTION_MAX_LENGTH || strlen($description) < Product::DESCRIPTION_MIN_LENGTH) {
            throw ProductException::wrongProductDescription();
        }

        if ($price->isZero() || $price->greaterThan(new Money(99999990, new Currency('PLN')))) {
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
    public function price(): Money
    {
        return $this->price;
    }

}