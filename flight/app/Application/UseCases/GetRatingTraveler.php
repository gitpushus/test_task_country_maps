<?php
namespace App\Application\UseCases;
use App\Domain\Repositories\RatingRepositoryInterface;

class GetRatingTraveler
{
    public function __construct(
        private readonly RatingRepositoryInterface $repository
    ){}
    public function execute(int $traveler_id) : array
    {
        return $this->repository->getRatingTraveler($traveler_id);
    }
}