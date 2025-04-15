<?php
namespace App\Domain\Dto;

class UpdateAttractionDto{
    public function __construct(
        public int $id,
        public ?string $name = null,
        public ?int $distance_from_center = null,
        public ?int $city_id = null,
    )
    {
        if ($city_id !== null && $city_id <= 0){
            throw new \InvalidArgumentException("Attraction city_id must be bigger 0");
        }
        if ($distance_from_center !== null && $distance_from_center < 0){
            throw new \InvalidArgumentException("Attraction distance_from_center must be bigger 0");
        }
        if ($name !== null && empty($name)){
            throw new \InvalidArgumentException("Attraction name cannot be empty");
        }
    }
}