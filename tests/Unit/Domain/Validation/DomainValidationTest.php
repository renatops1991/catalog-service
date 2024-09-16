<?php

namespace Tests\Unit\Domain\Validation;


use Application\Domain\Exception\EntityExceptionError;
use Application\Domain\Validation\DomainValidation;

describe('Domain Validation', function () {
    beforeEach(function (){
        $this->validation =  new DomainValidation();
    });

    it("Should throw EntityExceptionError if property is null", function() {
        $this->validation::isNotNull('');
    })->throws(EntityExceptionError::class, "Property cannot be null");

    it("Should throw EntityExceptionError if property has character greater than value provided", function() {
        $this->validation::validatePropertyRange('foo', 4, 5, "Property must be between 2 and 5");
    })->throws(EntityExceptionError::class, "Property must be between 2 and 5");
});
