<?php

namespace Core\Application\UseCases\DTO\Category;

class ListCategoryOutputDto
{
    public function __construct(
        public array $items = [],
        public int   $total = 0,
    )
    {
    }
}