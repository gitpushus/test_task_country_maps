<?php
namespace App\Domain\Dto;
use App\Domain\Exceptions\RatingBadRequestException;

class RatingDto
{
    public function __construct(
        public ?int $traveler_id,
        public ?int $attraction_id,
        public ?int $score,
    ){
        if (is_null($traveler_id)){
            throw new RatingBadRequestException("Field traveler_id is required");
        }
        if (is_null($attraction_id)){
            throw new RatingBadRequestException("Field attraction_id is required");
        }
        if (is_null($score)){
            throw new RatingBadRequestException("Field score is required");
        }
        if ($score > 5 || $score < 0) {
            throw new RatingBadRequestException("Incorrect fields data");
        }
    }

}