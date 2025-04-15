<?php
namespace App\Application\UseCases;
use App\Domain\Dto\CreateAttractionDto;
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
    public function execute(CreateAttractionDto $attractionDto):int
    {
        $distance_from_center = $attractionDto->distance_from_center;
        $name = $attractionDto->name;
        $city_id = $attractionDto->city_id;
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