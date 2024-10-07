<?php

namespace Application\Domain\Entity;

use Application\Domain\Entity\Traits\MagicMethodsTrait;
use Application\Domain\Exception\EntityExceptionError;
use Application\Domain\Validation\DomainValidation;
use Application\Domain\ValueObject\Uuid;
use DateTime;

class Category
{
    use MagicMethodsTrait;

    /**
     * @throws EntityExceptionError
     */
    public function __construct(
        protected Uuid|string     $id = '',
        protected string          $name = '',
        protected string          $description = '',
        protected bool            $isActive = true,
        protected DateTime|string $createdAt = '',
        protected DateTime|string $updatedAt = '',
    )
    {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::generateId();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
        $this->updatedAt = $this->updatedAt ? new DateTime($this->updatedAt) : new DateTime();
        $this->validate();
    }

    public function toggleActive(): void
    {
        $this->isActive = !$this->isActive;
    }

    /**
     * @throws EntityExceptionError
     */
    public function update(string $name, string $description = ''): void
    {
        $this->validate();

        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @throws EntityExceptionError
     */
    public function validate(): void
    {
        DomainValidation::isNotNull($this->name, "This name not be empty");
        DomainValidation::validatePropertyRange($this->name, 2, 100, "Name must be greater than two characters and less than 100 characters");
        DomainValidation::validateOptionalPropertyRange($this->description, 2, 255, "Description must be greater than two characters and less than 255 characters");
    }
}