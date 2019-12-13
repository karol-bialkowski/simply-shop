<?php

declare(strict_types=1);

namespace App\Product\Domain\Exception;

use App\Product\Domain\Product;

class ProductException extends \InvalidArgumentException
{
    public static function wrongProductName()
    {
        return new self(sprintf('Product name must be less than ' . Product::NAME_MAX_LENGTH . ' characters and greater than ' . Product::NAME_MIN_LENGTH));
    }

    public static function wrongProductDescription()
    {
        return new self(sprintf('Product description must be less than ' . Product::DESCRIPTION_MAX_LENGTH . ' characters and greater than ' . Product::DESCRIPTION_MIN_LENGTH));
    }

    public static function wrongProductPrice()
    {
        return new self(sprintf('Product price must be greater than 0'));
    }
}