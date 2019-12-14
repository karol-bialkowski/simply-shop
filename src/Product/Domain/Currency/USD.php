<?php

declare(strict_types=1);

namespace App\Product\Domain\Currency;

use Money\Money;

class USD implements CurrencyInterface
{

    //TODO: receive online exchange rate, via API and cache
    const EXCHANGE_RATE = 0.2597;
    const PREFIX_BEFORE = true;
    const PREFIX = '$';

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