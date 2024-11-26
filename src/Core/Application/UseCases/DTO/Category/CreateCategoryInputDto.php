<?php

namespace Core\Application\UseCases\DTO\Category;

class CreateCategoryInputDto
{
    public function __construct(public string $name, public string $description = '', public bool $isActive = true)
    {
    }
}