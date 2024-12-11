<?php

namespace Tests\Unit\Application\UseCases;

use Core\Application\UseCases\Category\ListCategoryUseCase;
use Core\Application\UseCases\DTO\Category\ListCategoryInputDto;
use Core\Application\UseCases\DTO\Category\ListCategoryOutputDto;
use Core\Domain\Repository\Interfaces\CategoryRepository;
use Core\Domain\Repository\Interfaces\Pagination;

function mockPagination(): Pagination
{
    $paginationMock = \Mockery::mock(Pagination::class);
    $paginationMock->shouldReceive('items')->andReturn([
        [
            'id' => '1',
            'name' => 'foo',
            'description' => 'bar',
            'is_active' => true,
            'createdAt' => '2009-12-19 16:54:20',
            'updatedAt' => '2009-12-19 16:54:20',
        ],
    ]);
    $paginationMock->shouldReceive('total')->andReturn(1);
    $paginationMock->shouldReceive('firstPage')->andReturn(1);
    $paginationMock->shouldReceive('lastPage')->andReturn(1);
    $paginationMock->shouldReceive('currentPage')->andReturn(1);
    $paginationMock->shouldReceive('totalPerPage')->andReturn(1);
    $paginationMock->shouldReceive('to')->andReturn(1);
    $paginationMock->shouldReceive('from')->andReturn(1);

    return $paginationMock;

};

describe('ListCategoryUseCase::execute', function () {
    $paginationMock = mockPagination();

    beforeEach(function () use ($paginationMock) {
        $this->repositoryMock = \Mockery::mock(\stdClass::class, CategoryRepository::class);
        $this->repositoryMock->shouldReceive('paginate')->andReturn($paginationMock);
        $this->listCategoryUseCaseMock = new ListCategoryUseCase($this->repositoryMock);
    });

    test('Should call paginate method from repository with correct parameters', function () use ($paginationMock) {
        $listCategoryInputDtoFixture = new ListCategoryInputDto(
            filter: 'id',
        );
        $this->repositorySpy = \Mockery::spy(\stdClass::class, CategoryRepository::class);
        $this->repositorySpy->shouldReceive('paginate')->andReturn($paginationMock);

        $listCategoryUseCaseMock = new ListCategoryUseCase($this->repositorySpy);
        $listCategoryUseCaseMock->execute($listCategoryInputDtoFixture);

        expect($this->repositorySpy)->shouldHaveReceived('paginate')
            ->once()
            ->withArgs(function ($filter) {
                expect($filter)->toBe('id');
                return true;
            });
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
            total_per_page: 1,
            current_page: 1,
            first_page: 1,
            last_page: 1,
            to: 1,
            from: 1,
        ));
    });

    function tearDown(): void
    {
        \Mockery::close();
    }
});

