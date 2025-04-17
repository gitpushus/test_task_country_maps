<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Rating;

interface RatingRepositoryInterface{
    public function create(Rating $rating): int;
    public function getRatingAttraction(int $attraction_id): array;
    public function getRatingTraveler(int $traveler_id): array;
}