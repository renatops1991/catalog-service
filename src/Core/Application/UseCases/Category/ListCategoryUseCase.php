<?php

namespace Core\Application\UseCases\Category;

use Core\Application\UseCases\DTO\Category\ListCategoryInputDto;
use Core\Application\UseCases\DTO\Category\ListCategoryOutputDto;
use Core\Domain\Repository\Interfaces\CategoryRepository;

readonly class ListCategoryUseCase
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    )
    {
    }

    public function execute(ListCategoryInputDto $listCategoryInputDto): ListCategoryOutputDto
    {
        $categories = $this->categoryRepository->paginate(
            filter: $listCategoryInputDto->filter,
            orderBy: $listCategoryInputDto->orderBy,
            page: $listCategoryInputDto->page,
            limit: $listCategoryInputDto->limit
        );

        return new ListCategoryOutputDto(
            items: $categories->items(),
            total: $categories->total(),
            total_per_page: $categories->totalPerPage(),
            current_page: $categories->currentPage(),
            first_page: $categories->firstPage(),
            last_page: $categories->lastPage(),
            to: $categories->to(),
            from: $categories->from(),
        );
    }
}