<?php
namespace App\Application\UseCases;
use App\Domain\Repositories\RatingRepositoryInterface;

class GetRatingAttraction
{
    public function __construct(
        private readonly RatingRepositoryInterface $repository
    ){}
    public function execute(int $attraction_id) : array
    {
        return $this->repository->getRatingAttraction($attraction_id);
    }
}