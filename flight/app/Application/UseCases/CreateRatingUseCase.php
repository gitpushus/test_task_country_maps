<?php
namespace App\Application\UseCases;

use App\Domain\Dto\RatingDto;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Exceptions\TravelerNotFoundException;
Use App\Domain\Repositories\RatingRepositoryInterface;
use App\Domain\Entities\Rating;

class CreateRatingUseCase{
    public function __construct(
        private readonly RatingRepositoryInterface $repository,
        private readonly GetAttractionUseCase $getAttractionUseCase,
        private readonly GetTravelerUseCase  $getTravelerUseCase
    ){}

    /**
     * @throws AttractionNotFoundException
     * @throws TravelerNotFoundException
     */
    public function execute(RatingDto $rating_dto): int
    {
        $this->getAttractionUseCase->execute($rating_dto->attraction_id);
        $this->getTravelerUseCase->execute($rating_dto->traveler_id);
        $rating = new Rating(
            null,
            $rating_dto->traveler_id,
            $rating_dto->attraction_id,
            $rating_dto->score
        );
        return $this->repository->create($rating);
    }
}