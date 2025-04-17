<?php
namespace App\Domain\Dto;
use App\Domain\Exceptions\RatingBadRequestException;

class RatingDto
{
    public function __construct(
        public int $traveler_id,
        public int $attraction_id,
        public int $score,
    ){
        if ($score > 5 || $score < 0) {
            throw new RatingBadRequestException("Incorrect fields data");
        }
    }

}