<?php

declare(strict_types=1);

namespace Appto\Taxonomy\Application\Command\Category;

use Appto\Common\Application\Command\CommandHandler;
use Appto\Common\Domain\Number\NaturalNumber;
use Appto\Taxonomy\Domain\Category\Category;
use Appto\Taxonomy\Domain\Category\CategoryAlreadyExistsException;
use Appto\Taxonomy\Domain\Category\CategoryId;
use Appto\Taxonomy\Domain\Category\Title;
use Appto\Taxonomy\Domain\Category\CategoryRepository;

class CreateCategory implements CommandHandler
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(CreateCategoryRequest $command): void
    {
        if ($this->categoryRepository->find($command->id())) {
            throw new CategoryAlreadyExistsException($command->id());
        }

        $this->categoryRepository->save(
            new Category(
                new CategoryId($command->id()),
                new Title($command->title()),
                $command->description(),
                new NaturalNumber($command->position())
            )
        );
    }
}
