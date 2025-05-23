<?php
namespace App\Application\UseCases;

use App\Domain\Repositories\AttractionRepositoryInterface;
class GetAttractionsUseCase
{
    public function __construct(
        private readonly AttractionRepositoryInterface $repository
    ){}
    public function execute(?int $cityId, ?int $minRating): array{
        return $this->repository->getAll($cityId, $minRating);
    }
}