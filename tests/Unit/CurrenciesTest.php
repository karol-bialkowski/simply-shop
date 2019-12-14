<?php

namespace App\Tests\Unit;

use App\Product\Application\Query\ProductView;
use App\Product\Domain\ValueObject\ProductDescription;
use App\Product\Domain\ValueObject\ProductName;
use App\Product\Infrastructure\Doctrine\ORM\DoctrineProducts;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CurrenciesTest extends KernelTestCase
{

    /**
     * @var Generator
     */
    private Generator $faker;
    /**
     * @var ObjectManager
     */
    private $entityManager;
    /**
     * @var DoctrineProducts
     */
    private DoctrineProducts $products;

    public function setUp(): void
    {
        $this->faker = Factory::create();
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->products = new DoctrineProducts($this->entityManager);
    }

    public function testShouldCalculateCurrenciesCorrectly(): void
    {

        $expectedEurPrice = '11.81 €';
        $expectedUsdPrice = '$ 13.13';
        $expectedPlnPrice = '50.56 zł';

        $product = new ProductView(
            new ProductName('@@Example22222product@@'),
            new ProductDescription('Lorem lipsum dolor sit amet consectetur adipsiicng elit. 
            Lorem lipsum dolor sit amet consectetur adipsiicng elit.'),
            5056
        );

        $this->assertSame($expectedEurPrice, $product->price('EUR'));
        $this->assertSame($expectedPlnPrice, $product->price('PLN'));
        $this->assertSame($expectedUsdPrice, $product->price('USD'));

    }
}