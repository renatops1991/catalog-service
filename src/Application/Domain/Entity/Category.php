<?php

namespace Application\Domain\Entity;

use Application\Domain\Entity\Traits\MagicMethodsTrait;
use Application\Domain\Exception\EntityExceptionError;

class Category
{
    use MagicMethodsTrait;

    /**
     * @throws EntityExceptionError
     */
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ) {
        $this->validate();
    }

    public function toggleActive(): void {
        $this->isActive = !$this->isActive;
    }

    /**
     * @throws EntityExceptionError
     */
    public function update(string $name, string $description = ''): void {
        $this->validate();

        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @throws EntityExceptionError
     */
    public function validate(): void {
         if(empty($this->name)) throw new EntityExceptionError("This name not be empty");

         if(strlen($this->name) <= 2 && strlen($this->name > 100)) {
             throw new EntityExceptionError("Name must be greater than two characters and less than 100 characters");
         }

         if(isset($this->description) && (strlen($this->description) <= 2 && strlen($this->description > 255))) {
             throw new EntityExceptionError("Description must be greater than two characters and less than 255 characters");
         }
    }
}