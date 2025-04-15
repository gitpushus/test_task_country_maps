<?php
namespace App\Application\UseCases;
use App\Domain\Entities\City;
use App\Domain\Repositories\CityRepositoryInterface;
use App\Domain\Exceptions\CityNotFoundException;
class GetCityUseCase
{
    public function __construct(
        private readonly CityRepositoryInterface $repository
    ){}
    public function execute(int $id) : City{
        $city = $this->repository->getOne($id);
        if ($city == null){
            throw new CityNotFoundException($id);
        }
        return $city;
    }
}