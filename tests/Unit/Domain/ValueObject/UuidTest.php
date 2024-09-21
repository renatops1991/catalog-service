<?php

use Application\Domain\ValueObject\Uuid;
use http\Exception\InvalidArgumentException;

describe('Uuid', function () {
    beforeEach(function () {
        $this->uuid = new Uuid("12345678-1234-1234-1234-123456789012");
    });

    it("Should validate id provided", function() {
        $this->uuid->isValidId("12345678-1234-1234-1234-123456789012");
    })->throwsNoExceptions();

    it("Should throw InvalidArgumentException if id provided is not valid", function() {
        $this->uuid->isValidId("abc");
    })->throws(InvalidArgumentException::class, "Id provided is not valid");
});