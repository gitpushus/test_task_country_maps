<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\CityNotFoundException;
use App\Domain\Repositories\CityRepositoryInterface;

class DeleteCityUseCase
{
    public function __construct(
        private readonly CityRepositoryInterface $repository,
        private readonly GetCityUseCase $getCityUseCase
    ){}

    /**
     * @throws CityNotFoundException
     */
    public function execute(int $id): void{
        $city = $this->getCityUseCase->execute($id);
        $this->repository->delete($city->id);
    }
}