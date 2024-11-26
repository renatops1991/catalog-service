<?php

namespace Core\Application\UseCases\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityExceptionError;
use Core\Application\UseCases\DTO\Category\{CreateCategoryInputDto, CreateCategoryOutputDto};
use Core\Domain\Repository\Interfaces\CategoryRepository;

class CreateCategoryUseCase
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }

    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive
        );
        $response = $this->categoryRepository->create($category);

        return new CreateCategoryOutputDto(
            id: $response->getId(),
            name: $response->name,
            description: $response->description,
            is_active: $response->isActive,
            createdAt: $response->getCreatedAt(),
            updatedAt: $response->getUpdatedAt()
        );
    }
}