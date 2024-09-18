<?php
namespace Tests\Unit\Domain\Entity;

use Application\Domain\Entity\Category;
use Application\Domain\Exception\EntityExceptionError;

describe('Category', function() {
    beforeEach(function(){
        $this->category = new Category(
            name: 'foo',
            description: 'bar',
            isActive: true
        );
    });

    it('Should exists properties in Category class', function(){
        expect($this->category->name)->toEqual('foo')
            ->and($this->category->description)->toEqual('bar')
            ->and($this->category->isActive)->toEqual(true);
    });
});

describe("toggleActive", function(){
    beforeEach(function(){
        $this->category = new Category(
            name: 'foo',
            description: 'bar',
            isActive: false
        );
    });

    it('Should set true isActive property value if has false value', function() {
        $this->category->toggleActive();
        expect($this->category->isActive)->toBeTrue();
    });

    it('Should set false isActive property value if has true value', function() {
        $this->category->isActive = true;
        $this->category->toggleActive();
        expect($this->category->isActive)->toBeFalse();
    });
});

describe("update", function(){
    beforeEach(function(){
        $this->category = new Category(
            name: 'foo',
            description: 'bar',
            isActive: false
        );
    });

    it('Should update name and description property by Id', function() {
        $this->category->update("john", "doe");
        expect($this->category->name)->toEqual("john")
            ->and($this->category->description)->toEqual("doe");
    });

    it('Should throw EntityExceptionError if description is less than two characters', function(){
        $this->category = new Category(
            name: 'foo',
            description: 'b',
            isActive: false
        );
    })->throws(EntityExceptionError::class, "Description must be greater than two characters");

    it('Should throw EntityExceptionError if name is less than two characters', function(){
        $this->category = new Category(
            name: 'r',
            description: 'bar',
            isActive: false
        );
    })->throws(EntityExceptionError::class, "Name must be greater than two characters and less than 100 characters");

    it('Should not throw EntityExceptionError if description or name has correct value', function(){
        $this->category = new Category(
            name: 'foo',
            description: 'john foo bar',
            isActive: false
        );
    })->throwsNoExceptions();

});