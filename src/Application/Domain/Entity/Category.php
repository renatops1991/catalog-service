<?php

namespace Application\Domain\Entity;

use Application\Domain\Entity\Traits\MagicMethodsTrait;

class Category
{
    use MagicMethodsTrait;

    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ) {}

    public function toggleActive(): void {
        $this->isActive = !$this->isActive;
    }
}