<?php
namespace Tests\Unit\Domain\Entity\ValueObject;

use Application\Domain\ValueObject\Uuid;
use \InvalidArgumentException;

describe('Uuid', function () {

    describe("isValid", function() {
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

    describe("generateId", function () {
        beforeEach(function () {
            $this->uuid = new Uuid("12345678-1234-1234-1234-123456789012");
        });

        it("Should generate a valid id", function(){
            $response = $this->uuid::generateId();
            expect($response)->toBeInstanceOf(Uuid::class);
        });
    });
});