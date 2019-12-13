<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Doctrine\Dbal;

use App\Product\Application\Query\ProductQuery;
use App\Product\Application\Query\ProductView;
use Doctrine\DBAL\Connection;

final class DbalProductQuery implements ProductQuery
{

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function count(): int
    {
        // TODO: Implement count() method.
    }

    public function getById(int $id): ProductView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('p.name', 'p.id')
            ->from('product', 'p')
            ->where('p.id = :productId')
            ->setParameter('productId', $id);

        $productData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        return new ProductView($productData['name']);

    }

    public function getAll()
    {
    }
}