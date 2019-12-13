<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

use App\Product\Domain\ValueObject\ProductDescription;
use App\Product\Domain\ValueObject\ProductName;

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

    public function __construct(ProductName $name, ProductDescription $description)
    {
        $this->name = $name;
        $this->description = $description;
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
}