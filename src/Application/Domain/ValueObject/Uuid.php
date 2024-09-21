<?php

namespace Application\Domain\ValueObject;
use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid as UuidGenerator;


class Uuid {
    public function __construct(
        protected string $id
    ) {
        $this->isValidId($id);
    }

    public function isValidId(string $id): void {
        if(!UuidGenerator::isValid($id)) {
            throw new InvalidArgumentException("Id provided is not valid");
        }
    }
}