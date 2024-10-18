<?php
namespace Tests\Unit\Domain\Entity\ValueObject;

use Core\Domain\ValueObject\Uuid;
use \InvalidArgumentException;

describe('Uuid', function () {
    describe("generateId", function () {
        it("Should generate a valid id", function() {
            $uuid = new Uuid("12345678-1234-1234-1234-123456789012");
            $response = $uuid::generateId();
            expect($response)->toBeInstanceOf(Uuid::class);
        });

        it("Should return uuid correctly", function() {
            $uuid = new Uuid("12345678-1234-1234-1234-123456789012");
            $response = $uuid::generateId();
            expect($response)->toEqual($response->__toString());
        });

        it("Should throw InvalidArgumentException if id provided is not valid", function() {
            $uuid = new Uuid("ab");
            $response = $uuid::generateId();
        })->throws(InvalidArgumentException::class, "Id provided is not valid");
    });
});