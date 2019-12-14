<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Doctrine\Dbal;

use App\Product\Application\Query\ProductQuery;
use App\Product\Application\Query\ProductView;
use App\Product\Domain\ValueObject\ProductDescription;
use App\Product\Domain\ValueObject\ProductName;
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

    public function getByName(string $name): ProductView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('p.name', 'p.id', 'p.description', 'p.price')
            ->from('product', 'p')
            ->where('p.id = :productName')
            ->setParameter('productName', $name);

        $productData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        return new ProductView(
            new ProductName($productData['name']),
            new ProductDescription($productData['description']),
            (int) $productData['price']
        );
    }

    public function getById(int $id): ProductView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('p.name', 'p.id', 'p.description', 'p.price')
            ->from('product', 'p')
            ->where('p.id = :productId')
            ->setParameter('productId', $id);

        $productData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        return new ProductView(
            new ProductName($productData['name']),
            new ProductDescription($productData['description']),
            (int) $productData['price']
        );

    }

    public function getAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->select('p.name', 'p.id', 'p.description', 'p.price', 'p.created_at')
            ->from('product', 'p')
            ->orderBy('p.id', 'DESC');

        return $this->connection->fetchAll($queryBuilder->getSQL(), $queryBuilder->getParameters());
    }
}