<?php

namespace App\Product\Application\Command\Handler;

use App\Product\Application\Command\CreateNewProduct;
use App\Product\Infrastructure\Doctrine\ORM\DoctrineProducts;
use App\Product\Domain\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateNewProductHandler implements MessageHandlerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var DoctrineProducts
     */
    private $products;

    /**
     * CreateNewProductHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->products = new DoctrineProducts($this->entityManager); //TODO: refactor this to more sexy
    }

    /**
     * @param CreateNewProduct $createNewProduct
     */
    public function __invoke(CreateNewProduct $createNewProduct): void
    {
        $product = new Product(
            $createNewProduct->name()
        );

        $this->products->add($product);
    }

}