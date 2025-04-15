<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Repositories\AttractionRepositoryInterface;

class DeleteAttractionUseCase{
    public function __construct(
        private AttractionRepositoryInterface $repository,
        private GetAttractionUseCase $getAttractionUseCase
    ){}

    /**
     * @throws AttractionNotFoundException
     */
    public function execute($id):void
    {
        $this->getAttractionUseCase->execute($id);
        $this->repository->delete($id);
    }
}