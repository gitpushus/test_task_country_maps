<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\TravelerNotFoundException;
use App\Domain\Repositories\TravelerRepositoryInterface;

class DeleteTravelerUseCase {
    public function __construct(
        private readonly TravelerRepositoryInterface $repository,
        private readonly GetTravelerUseCase $getTravelerUseCase
    ){}

    /**
     * @throws TravelerNotFoundException
     */
    public function execute(int $id): void
    {
        $this->getTravelerUseCase->execute($id);
        $this->repository->delete($id);
    }
}