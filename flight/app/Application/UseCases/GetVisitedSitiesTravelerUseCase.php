<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\TravelerNotFoundException;
use App\Domain\Repositories\TravelerRepositoryInterface;

class GetVisitedSitiesTravelerUseCase{
    public function __construct(
        private readonly TravelerRepositoryInterface $repository
    ){}

    /**
     * @throws TravelerNotFoundException
     */
    public function execute(int $id): array{
        $traveler = $this->repository->getOne($id);
        if ($traveler === null){
            throw new TravelerNotFoundException($id);
        }
        return $this->repository->getVisitedSities($id);
    }
}