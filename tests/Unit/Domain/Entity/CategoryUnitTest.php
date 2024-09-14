<?php
namespace Tests\Unit\Domain\Entity;

use Application\Domain\Entity\Category;

describe('Category', function() {
    beforeEach(function(){
        $this->category = new Category(
            name: 'foo',
            id: 'foo',
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