<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityExceptionError;
use Core\Domain\ValueObject\Uuid;

describe('Category', function () {
    beforeEach(function () {
        $this->category = new Category(
            name: 'foo',
            description: 'bar',
            isActive: true
        );
    });

    test('Should exists properties in Category class', function () {
        expect($this->category->name)->toEqual('foo')
            ->and($this->category->description)->toEqual('bar')
            ->and($this->category->isActive)->toEqual(true)
            ->and($this->category->id)->toBeInstanceOf(Uuid::class)
            ->and($this->category->createdAt)->toBeInstanceOf(\DateTime::class)
            ->and($this->category->updatedAt)->toBeInstanceOf(\DateTime::class);
    });
});

describe("toggleActive", function () {
    beforeEach(function () {
        $this->category = new Category(
            name: 'foo',
            description: 'bar',
            isActive: false
        );
    });

    test('Should set true isActive property value if has false value', function () {
        $this->category->toggleActive();
        expect($this->category->isActive)->toBeTrue();
    });

    test('Should set false isActive property value if has true value', function () {
        $this->category->isActive = true;
        $this->category->toggleActive();
        expect($this->category->isActive)->toBeFalse();
    });
});


describe("update", function () {
    test('Should update name and description property by Id', function () {
        $uuid = Uuid::generateId();
        $this->category = new Category(
            id: $uuid,
            name: 'foo',
            description: 'bar',
            isActive: false,
            createdAt: '2023-01-01 00:00:00',
            updatedAt: '2023-01-01 00:00:00'
        );

        $this->category->update("john", "doe");

        expect($this->category->name)->toEqual("john")
            ->and($this->category->description)->toEqual("doe")
            ->and($this->category->getId())->toEqual($uuid)
            ->and($this->category->createdAt)->toEqual(new \DateTime('2023-01-01 00:00:00'))
            ->and($this->category->createdAt)->tobeInstanceOf(\DateTime::class)
            ->and($this->category->updatedAt)->toBeInstanceOf(\DateTime::class)
            ->and($this->category->updatedAt)->toEqual(new \DateTime('2023-01-01 00:00:00'));
    });

    test('Should throw EntityExceptionError if description is less than two characters', function () {
        $this->category = new Category(
            name: 'foo',
            description: 'b',
            isActive: false
        );
    })->throws(EntityExceptionError::class, "Description must be greater than two characters");

    test('Should throw EntityExceptionError if name is less than two characters', function () {
        $this->category = new Category(
            name: 'r',
            description: 'bar',
            isActive: false
        );
    })->throws(EntityExceptionError::class, "Name must be greater than two characters and less than 100 characters");

    test('Should not throw EntityExceptionError if description or name has correct value', function () {
        $this->category = new Category(
            name: 'foo',
            description: 'john foo bar',
            isActive: false
        );
    })->throwsNoExceptions();

});