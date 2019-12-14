<?php

declare(strict_types=1);

namespace App\Product\Domain\Currency;

use Money\Money;

class EUR implements CurrencyInterface
{

    const EXCHANGE_RATE = 0.2336;
    const PREFIX_BEFORE = false;
    const PREFIX = '€';

    /**
     * @var Money
     */
    private Money $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getAmount(): Money
    {
        return $this->money->multiply(self::EXCHANGE_RATE);
    }

    public function format(string $inputPrice): string
    {
        if (self::PREFIX_BEFORE) {
            return self::PREFIX . ' ' . $inputPrice;
        }

        return $inputPrice . ' ' . self::PREFIX;
    }


}