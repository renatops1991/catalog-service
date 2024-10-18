<?php

namespace Tests\Unit\Domain\Validation;


use Core\Domain\Exception\EntityExceptionError;
use Core\Domain\Validation\DomainValidation;

describe('Domain Validation', function () {
    beforeEach(function (){
        $this->validation =  new DomainValidation();
    });

    it("Should throw EntityExceptionError if property is null", function() {
        $this->validation::isNotNull('');
    })->throws(EntityExceptionError::class, "Property cannot be null");

    it("Should throw EntityExceptionError if property has character greater than range value provided", function() {
        $this->validation::validatePropertyRange('foo', 1, 2, "Property must be between 2 and 5");
    })->throws(EntityExceptionError::class, "Property must be between 2 and 5");

    it("Should throw EntityExceptionError if property has character less than range value provided", function() {
        $this->validation::validatePropertyRange('foo', 4, 10, "Property must be between 2 and 5");
    })->throws(EntityExceptionError::class, "Property must be between 2 and 5");

    it("Should throw EntityExceptionError if property is not null and quantity character less than range value provided", function() {
        $this->validation::validateOptionalPropertyRange('f', 2, 5, "Property must be between 2 and 5");
    })->throws(EntityExceptionError::class, "Property must be between 2 and 5");

    it("Should throw EntityExceptionError if property is not null and quantity character greater than range value provided", function() {
        $this->validation::validateOptionalPropertyRange('foobarxis', 2, 5, "Property must be between 2 and 5");
    })->throws(EntityExceptionError::class, "Property must be between 2 and 5");

    it("Should not throw  EntityExceptionError if property provided is null", function() {
        $this->validation::validateOptionalPropertyRange('', 2, 5, "Property must be between 2 and 5");
    })->throwsNoExceptions();
});
