<?php

namespace Core\Application\UseCases\DTO\Category;

class ListCategoryOutputDto
{
    public function __construct(
        public array $items = [],
        public int   $total = 0,
        public int   $total_per_page = 15,
        public int   $current_page = 1,
        public int   $first_page = 1,
        public int   $last_page = 1,
        public int   $to = 1,
        public int   $from = 1,
    )
    {
    }
}