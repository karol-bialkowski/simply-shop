<?php

declare(strict_types=1);

namespace App\Product\Domain\Currency;

use Money\Money;

class PLN implements CurrencyInterface
{

    const EXCHANGE_RATE = 1;
    const PREFIX_BEFORE = false;
    const PREFIX = 'zł';

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
        return $this->money;
    }

    public function format(string $inputPrice): string
    {
        if (self::PREFIX_BEFORE) {
            return self::PREFIX . ' ' . $inputPrice;
        }

        return $inputPrice . ' ' . self::PREFIX;
    }


}