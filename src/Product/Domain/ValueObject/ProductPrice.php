<?php

declare(strict_types=1);

namespace App\Product\Domain\ValueObject;

use Money\Money;

class ProductPrice
{
    /**
     * @var Money
     */
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    /**
     * @return int
     */
    public function getProductPrice(): int
    {
        return (int)$this->money->getAmount();
    }
}