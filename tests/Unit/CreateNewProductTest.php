<?php

namespace App\Tests\Unit;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Domain\Exception\ProductException;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use TypeError;

class CreateNewProductTest extends TestCase
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testShouldThrowProductWrongNameException(): void
    {
        $this->expectExceptionObject(ProductException::wrongProductName());
        new CreateNewProduct('', '', 0);
    }

    public function testShouldThrowProductWrongDescriptionException(): void
    {
        $this->expectExceptionObject(ProductException::wrongProductDescription());
        new CreateNewProduct('Example Funny Karol`s book', 'Description has less than 100 characters', 0);
    }

    public function testShouldErrorWithMissingPriceParameters(): void
    {
        $this->expectException(TypeError::class);
        new CreateNewProduct(
            $this->faker->realText(100),
            $this->faker->realText(255),
            null
        );
    }

    public function testShouldThrowErrorWithWrongPrice(): void
    {
        $this->expectExceptionObject(ProductException::wrongProductPrice());
        new CreateNewProduct(
            $this->faker->realText(100),
            $this->faker->realText(255),
            8979879878978979789
        );
    }
}