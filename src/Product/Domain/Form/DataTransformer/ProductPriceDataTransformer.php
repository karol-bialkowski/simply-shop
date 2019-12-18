<?php

declare(strict_types=1);

namespace App\Product\Domain\Form\DataTransformer;

use Money\Currencies\ISOCurrencies;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use Symfony\Component\Form\DataTransformerInterface;

class ProductPriceDataTransformer implements DataTransformerInterface
{
    /**
     * @var DecimalMoneyParser
     */
    private DecimalMoneyParser $moneyParser;

    public function __construct()
    {
        $this->moneyParser = new DecimalMoneyParser(new ISOCurrencies());
    }

    /**
     * @inheritDoc
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value): Money
    {
        return $this->moneyParser->parse($value, 'PLN');
    }
}