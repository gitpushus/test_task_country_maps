<?php
namespace App\Domain\Entities;

class Attraction{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly int $distance_from_center,
        public readonly int $city_id,
    ){}
}