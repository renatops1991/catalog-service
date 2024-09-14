<?php

namespace Application\Domain\Entity;

class Category
{
    public function __construct(
        public string $name,
        public string $id ='',
        public string $description = '',
        public bool $isActive = true,
    ) {}
}