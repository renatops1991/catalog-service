<?php

namespace Core\Application\UseCases\DTO\Category;

class ListCategoryInputDto
{
    public function __construct(
        public array|string $filter = '',
        public string       $orderBy = 'DESC',
        public int          $page = 1,
        public int          $limit = 15
    ){}
}