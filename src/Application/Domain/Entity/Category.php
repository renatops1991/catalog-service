<?php

namespace Application\Domain\Entity;

use Application\Domain\Entity\Traits\MagicsMethodTrait;

class Category
{
    use MagicsMethodTrait;

    public function __construct(
        protected string $name,
        protected string $id ='',
        protected string $description = '',
        protected bool $isActive = true,
    ) {}
}