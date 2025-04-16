<?php
namespace App\Application\UseCases;
use App\Domain\Repositories\TravelerRepositoryInterface;
class GetTravelersUseCase{
    public function __construct(
        private readonly TravelerRepositoryInterface $repository
    ){}
    public function execute(): array
    {
        return $this->repository->getAll();
    }
}