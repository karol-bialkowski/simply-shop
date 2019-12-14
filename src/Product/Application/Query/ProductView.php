<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

use App\Product\Domain\Currency\EUR;
use App\Product\Domain\Currency\PLN;
use App\Product\Domain\Currency\USD;
use App\Product\Domain\ValueObject\ProductDescription;
use App\Product\Domain\ValueObject\ProductName;
use Money\Currency;
use Money\Money;

final class ProductView
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var ProductDescription
     */
    private ProductDescription $description;
    /**
     * @var int
     */
    private int $price;

    public function __construct(ProductName $name, ProductDescription $description, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return ProductName
     */
    public function name(): ProductName
    {
        return $this->name;
    }

    /**
     * @return ProductDescription
     */
    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function price($currency = 'PLN')
    {
        $money = new Money($this->price, new Currency($currency));
        //TODO: refactor this, reflection class
        switch ($currency) {
            case 'PLN':
                $selectedCurrency = new PLN($money);
                break;
            case 'EUR':
                $selectedCurrency = new EUR($money);
                break;
            case 'USD':
                $selectedCurrency = new USD($money);
                break;
            default:
                $selectedCurrency = new PLN($money);
        }

        $price = new \App\Product\Domain\Currency\Currency($selectedCurrency);
        return $selectedCurrency->format($price->format());
    }
}