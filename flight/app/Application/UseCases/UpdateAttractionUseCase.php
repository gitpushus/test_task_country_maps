<?php
namespace App\Application\UseCases;

use App\Domain\Dto\UpdateAttractionDto;
use App\Domain\Entities\Attraction;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Exceptions\CityNotFoundException;
use App\Domain\Repositories\AttractionRepositoryInterface;
use App\Application\UseCases\GetAttractionUseCase;

class UpdateAttractionUseCase
{
    public function __construct(
       private readonly AttractionRepositoryInterface $repository,
       private readonly GetAttractionUseCase $getAttractionUseCase,
       private readonly GetCityUseCase $getCityUseCase,
    ){}

    /**
     * @throws AttractionNotFoundException
     * @throws CityNotFoundException
     */
    public function execute(UpdateAttractionDto $attractionDto):void
    {
        $attraction = $this->getAttractionUseCase->execute($attractionDto->id);
        if ($attractionDto->city_id !== null){
            $this->getCityUseCase->execute($attractionDto->city_id);
        }
        $updatedAttraction = new Attraction(
            $attraction->id,
            $attractionDto->name ?? $attraction->name,
            $attractionDto->distance_from_center ?? $attraction->distance_from_center,
            $attractionDto->city_id ?? $attraction->city_id,
        );
        $this->repository->update($updatedAttraction);
    }
}