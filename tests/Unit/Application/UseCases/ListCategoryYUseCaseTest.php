<?php

namespace Tests\Unit\Application\UseCases;

use Core\Application\UseCases\Category\ListCategoryUseCase;
use Core\Application\UseCases\DTO\Category\ListCategoryInputDto;
use Core\Application\UseCases\DTO\Category\ListCategoryOutputDto;
use Core\Domain\Repository\Interfaces\CategoryRepository;
use Core\Domain\Repository\Interfaces\Pagination;

describe('ListCategoryUseCase::execute', function () {
    beforeEach(function () {
        $this->paginationMock = \Mockery::mock(Pagination::class);
        $this->paginationMock->shouldReceive('items')->andReturn([
            [
                'id' => '1',
                'name' => 'foo',
                'description' => 'bar',
                'is_active' => true,
                'createdAt' => '2009-12-19 16:54:20',
                'updatedAt' => '2009-12-19 16:54:20',
            ],
        ]);
        $this->paginationMock->shouldReceive('total')->andReturn(1);
        $this->repositoryMock = \Mockery::mock(\stdClass::class, CategoryRepository::class);
        $this->repositoryMock->shouldReceive('paginate')->andReturn($this->paginationMock);
        $this->listCategoryUseCaseMock = new ListCategoryUseCase($this->repositoryMock);
    });

    test('Should return correctly list category array on success', function () {
        $listCategoryInputDtoFixture = new ListCategoryInputDto(
            filter: 'id',
        );

        $response = $this->listCategoryUseCaseMock->execute($listCategoryInputDtoFixture);
        expect($response)->toEqual(new ListCategoryOutputDto(
            items: [
                [
                    'id' => '1',
                    'name' => 'foo',
                    'description' => 'bar',
                    'is_active' => true,
                    'createdAt' => '2009-12-19 16:54:20',
                    'updatedAt' => '2009-12-19 16:54:20',
                ]
            ],
            total: 1,
        ));
    });
});