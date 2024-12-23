<?php

namespace Core\Application\UseCases\DTO\Category;

class UpdateCategoryOutputDto{
    public function __construct(
        public string          $id,
        public string          $name,
        public string          $description,
        public bool            $is_active,
        public string          $createdAt,
        public string          $updatedAt
    )
    {
    }
}