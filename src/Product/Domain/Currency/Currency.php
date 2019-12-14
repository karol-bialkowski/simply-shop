<?php

declare(strict_types=1);

namespace App\Product\Domain\Currency;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class Currency
{

    /**
     * @var Money
     */
    private Money $price;
    /**
     * @var CurrencyInterface
     */
    private CurrencyInterface $currency;

    public function __construct(CurrencyInterface $currency)
    {
        $this->currency = $currency;
    }

    public function format(): string
    {
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($this->currency->getAmount());
    }

}