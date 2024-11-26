<?php

namespace Tests\Unit\Application\UseCases;

use Core\Application\UseCases\Category\CreateCategoryUseCase;
use Core\Application\UseCases\DTO\Category\CreateCategoryInputDto;
use Core\Application\UseCases\DTO\Category\CreateCategoryOutputDto;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\Interfaces\CategoryRepository;
use Ramsey\Uuid\Uuid;

describe('CreateCategoryUseCase::execute', function () {
    beforeEach(function () {
        $this->uuidFixture = (string)Uuid::uuid4();
        $this->categoryEntityMock = new Category(
            id: $this->uuidFixture,
            name: 'foo',
            description: 'bar',
            isActive: true,
            createdAt: '2009-12-19 16:54:20',
            updatedAt: '2009-12-19 16:54:20'
        );

        $this->repositoryMock = \Mockery::mock(\stdClass::class, CategoryRepository::class);
        $this->repositoryMock->shouldReceive('create')->andReturn($this->categoryEntityMock);

        $this->createCategoryUseCase = new CreateCategoryUseCase($this->repositoryMock);
    });

    test('Should call create method on repository with correct parameters', function () {
        $createCategoryInputDtoMock = new CreateCategoryInputDto(
            name: 'foo',
            description: 'bar',
            isActive: true
        );
        $this->repositorySpy = \Mockery::spy(\stdClass::class, CategoryRepository::class);
        $this->repositorySpy->shouldReceive('create')->andReturn($this->categoryEntityMock);

        $useCase = new CreateCategoryUseCase($this->repositorySpy);
        $useCase->execute($createCategoryInputDtoMock);

        expect($this->repositorySpy)->shouldHaveReceived('create')->once();

    });

    test('Should return correctly category object on success', function () {
        $createCategoryInputDtoMock = new CreateCategoryInputDto(
            name: 'foo',
            description: 'bar',
            isActive: true
        );

        $response = $this->createCategoryUseCase->execute($createCategoryInputDtoMock);
        expect($response)->toEqual(new CreateCategoryOutputDto(
            id: $this->uuidFixture,
            name: 'foo',
            description: 'bar',
            is_active: true,
            createdAt: '2009-12-19 16:54:20',
            updatedAt: '2009-12-19 16:54:20'
        ));
    });
});