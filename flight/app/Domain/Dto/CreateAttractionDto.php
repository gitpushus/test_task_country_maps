<?php
namespace App\Domain\Dto;
use App\Domain\Exceptions\AttractionBadRequestException;

class CreateAttractionDto
{
    public function __construct(
        public string $name,
        public int $distance_from_center,
        public int $city_id
    ){
        if (empty($name) || $distance_from_center < 0 || $city_id <= 0) {
            throw new AttractionBadRequestException("Fields can't be empty");
        }
    }
}