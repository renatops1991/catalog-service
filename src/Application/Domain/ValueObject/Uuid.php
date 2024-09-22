<?php

namespace Application\Domain\ValueObject;

use \InvalidArgumentException;
use Ramsey\Uuid\Uuid as UuidGenerator;

class Uuid {
    public function __construct(
        protected string $id
    ) {
        $this->isValidId($id);
    }

    public static function generateId(): self {
        return new self(UuidGenerator::uuid4()->toString());
    }

    public function __toString(): string {
        return $this->id;
    }

    public function isValidId(string $id): void {
        if(!UuidGenerator::isValid($id)) {
            throw new InvalidArgumentException("Id provided is not valid");
        }
    }
}