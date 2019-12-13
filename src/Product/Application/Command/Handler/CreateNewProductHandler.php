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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(CreateNewProduct $createNewProduct)
    {
        $product = new Product(
            $createNewProduct->name()
        );

        $doctrineProducts = new DoctrineProducts($this->entityManager);
        $doctrineProducts->add($product);

        echo 'saving now...';
    }

}