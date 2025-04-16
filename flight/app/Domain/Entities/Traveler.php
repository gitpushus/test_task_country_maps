<?php
namespace App\Domain\Entities;
class Traveler{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ){}
}