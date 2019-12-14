<?php

declare(strict_types=1);

namespace App\Product\Domain\Currency;

use Money\Money;

interface CurrencyInterface
{

    public function __construct(Money $money);

    public function getAmount(): Money;

    public function format(string $inputPrice): string;

}