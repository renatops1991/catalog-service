<?php

namespace Core\Application\UseCases\DTO\Category;

use DateTime;

class CreateCategoryOutputDto
{
    public function __construct(
        public string          $id,
        public string          $name,
        public string          $description,
        public bool            $is_active,
        public DateTime|string $createdAt,
        public DateTime|string $updatedAt
    )
    {
    }
}