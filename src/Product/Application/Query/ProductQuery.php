<?php

declare(strict_types=1);

namespace App\Product\Application\Query;

interface ProductQuery
{

    public function count(): int;

    public function getById(int $id): ProductView;

    public function getAll();
}