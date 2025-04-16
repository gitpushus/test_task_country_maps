<?php
namespace App\Domain\Entities;
class Rating{
    public function __construct(
        public readonly ?int $id,
        public readonly int $traveler_id,
        public readonly int $attraction_id,
        public readonly int $score,
    ){}
}