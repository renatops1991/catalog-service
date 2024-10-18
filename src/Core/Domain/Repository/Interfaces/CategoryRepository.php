<?php

namespace Core\Domain\Repository\Interfaces;

use Core\Domain\Entity\Category;

interface CategoryRepository
{
    public function create(Category $category): Category;

    public function findById(string $id): Category;

    public function findAll(string $filter = '', string $orderBy = 'DESC', int $page = 1, int $limit = 15): array;

    public function update(Category $category): Category;

    public function delete(string $id): void;
}