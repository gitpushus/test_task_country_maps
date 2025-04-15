<?php
namespace App\Application\UseCases;
use App\Domain\Entities\Attraction;
use App\Domain\Exceptions\AttractionBadRequestException;
use App\Domain\Exceptions\CityNotFoundException;
use App\Domain\Repositories\AttractionRepositoryInterface;

class CreateAttractionUseCase
{
    public function __construct(
        private AttractionRepositoryInterface $repository,
        private GetCityUseCase $getCityUseCase,
    ){}

    /**
     * @throws CityNotFoundException
     */
    public function execute(string $name, int $distance_from_center, int $city_id):int
    {
        if (empty($distance_from_center) || empty($name) || empty($city_id)) {
            throw new AttractionBadRequestException("Fields can't be empty");
        }
        $city = $this->getCityUseCase->execute($city_id);
        $attraction = new Attraction(
            null,
            $name,
            $distance_from_center,
            $city->id
        );
        return $this->repository->create($attraction);
    }
}