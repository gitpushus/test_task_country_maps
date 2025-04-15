<?php
namespace App\Application\UseCases;
use App\Domain\Entities\City;
use App\Domain\Repositories\CityRepositoryInterface;

class GetCitiesUseCase
{
    public function __construct(
        private readonly CityRepositoryInterface $repository
    ){}
    public function execute() : array{
        return $this->repository->getAll();
    }
}