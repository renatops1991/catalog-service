<?php

namespace Application\Domain\Validation;

use Application\Domain\Exception\EntityExceptionError;

class DomainValidation {

    /**
     * @throws EntityExceptionError
     */
    public static function isNotNull(string $propertyValue, string $exceptionMessage = null): void {
        if(empty($propertyValue)) {
            throw new EntityExceptionError($exceptionMessage ?? "Property cannot be null");
        }
    }
}