<?php
namespace App\Application\UseCases;
use App\Domain\Entities\City;
use App\Domain\Exceptions\CityBadRequestException;
use App\Domain\Exceptions\CityNotFoundException;
use App\Domain\Repositories\CityRepositoryInterface;

class UpdateCityUseCase
{
    public function __construct(
        private readonly CityRepositoryInterface $repository,
        private readonly GetCityUseCase $getCityUseCase
    ){}

    /**
     * @throws CityNotFoundException
     */
    public function execute(int $id, string $name): void
    {
        $name = trim($name);
        if (empty($name)){
            throw new CityBadRequestException("City name can't be empty");
        }
        $city = $this->getCityUseCase->execute($id);
        $updatedCity = new City(
            $city->id,
            $name
        );
        $this->repository->update($updatedCity);
    }
}