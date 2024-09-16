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

    public static function validatePropertyRange(string $propertyValue, int $min = 2, int $max = 255, string $exceptionMessage = null): void {
        $propertyLength = strlen($propertyValue);
        if($propertyLength < $min || $propertyLength > $max)
            throw new EntityExceptionError($exceptionMessage ?? "Property must be between {$min} and {$max}");
    }

    public static function validateOptionalPropertyRange(string $propertyValue = '', int $min = 2, int $max = 255, string $exceptionMessage = null): void {
        if(!empty($propertyValue)) {
            $propertyLength = strlen($propertyValue);
            if($propertyLength < $min || $propertyLength > $max)
                throw new EntityExceptionError($exceptionMessage ?? "Property must be between {$min} and {$max}");
        }
    }
}