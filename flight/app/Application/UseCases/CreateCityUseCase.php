<?php
namespace App\Application\UseCases;
use App\Domain\Entities\City;
use App\Domain\Exceptions\CityBadRequestException;
use App\Domain\Repositories\CityRepositoryInterface;

class CreateCityUseCase
{
    public function __construct(
        private readonly CityRepositoryInterface $repository
    ){}

    public function execute(string $name): int
    {
        $name = trim($name);
        if (empty($name)){
            throw new CityBadRequestException("City name can't be empty");
        }
        $city = new City(
            null,
            $name
        );
        return $this->repository->create($city);
    }
}