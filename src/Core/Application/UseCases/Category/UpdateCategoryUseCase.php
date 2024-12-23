<?php

namespace Core\Application\UseCases\Category;


use Core\Application\UseCases\DTO\Category\UpdateCategoryInputDto;
use Core\Application\UseCases\DTO\Category\UpdateCategoryOutputDto;
use Core\Domain\Exception\EntityExceptionError;
use Core\Domain\Repository\Interfaces\CategoryRepository;

class UpdateCategoryUseCase
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }

    /**
     * @throws EntityExceptionError
     */
    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto
    {
        $category = $this->categoryRepository->findById($input->id);
        $category->update(
            name: $input->name,
            description: $input->description ?? $category->description
        );

        $response = $this->categoryRepository->update($category);

        return new UpdateCategoryOutputDto(
            id: $response->getId(),
            name: $response->name,
            description: $response->description,
            is_active: $response->isActive,
            createdAt: $response->getCreatedAt(),
            updatedAt: $response->getUpdatedAt()
        );
    }
}