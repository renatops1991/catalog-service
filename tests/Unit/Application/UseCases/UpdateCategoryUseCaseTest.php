<?php

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityExceptionError;
use Core\Domain\Repository\Interfaces\CategoryRepository;
use \Core\Application\UseCases\DTO\Category\UpdateCategoryInputDto;
use \Core\Application\UseCases\Category\UpdateCategoryUseCase;
use \Core\Application\UseCases\DTO\Category\UpdateCategoryOutputDto;

use Ramsey\Uuid\Uuid;

describe('UpdateCategoryUseCase', function () {

    beforeEach (/**
     * @throws DateMalformedStringException
     * @throws EntityExceptionError
     */ function () {
        $this->uuidFixture = (string)Uuid::uuid4();
        $this->categoryEntityMock = new Category(
            id: $this->uuidFixture,
            name: 'xis',
            description: 'other',
            isActive: true,
            createdAt: '2009-12-19 16:54:20',
            updatedAt: '2009-12-19 16:54:20'
        );

        $this->repositoryMock = \Mockery::mock(\stdClass::class, CategoryRepository::class);
        $this->repositoryMock->shouldReceive('update')->andReturn($this->categoryEntityMock);
        $this->repositoryMock->shouldReceive('findById')->andReturn($this->categoryEntityMock);

        $this->updateCategoryUseCase = new UpdateCategoryUseCase($this->repositoryMock);
    });

    test('Should update the category correctly', function () {
        $updateCategoryInputDtoFixture = new UpdateCategoryInputDto(
            id: $this->uuidFixture,
            name: 'xis',
            description: 'other',
            isActive: true,
        );

        $response = $this->updateCategoryUseCase->execute($updateCategoryInputDtoFixture);
        expect($response)->toEqual(new UpdateCategoryOutputDto(
            id: $this->uuidFixture,
            name: 'xis',
            description: 'other',
            is_active: true,
            createdAt: '2009-12-19 16:54:20',
            updatedAt: '2009-12-19 16:54:20'
        ));
    });
    function tearDown(): void
    {
        \Mockery::close();
    }
});