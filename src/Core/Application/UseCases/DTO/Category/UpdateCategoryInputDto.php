<?php

namespace Core\Application\UseCases\DTO\Category;

use Ramsey\Uuid\Uuid;

class UpdateCategoryInputDto
{
    public function __construct(
        public Uuid|string $id,
        public string      $name,
        public string|null $description = null,
        public bool        $isActive = true
    )
    {
    }
}