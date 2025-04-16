<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Rating;

interface RatingRepositoryInterface{
    public function create(Rating $ratingDto): void;
    public function getRatingAttraction(int $attraction_id): Rating;
    public function getRatingTraveler(int $traveler_id): Rating;
}