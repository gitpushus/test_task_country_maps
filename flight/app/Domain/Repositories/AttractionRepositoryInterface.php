<?php
namespace App\Domain\Repositories;
use App\Domain\Entities\Attraction;
interface AttractionRepositoryInterface {
    public function getAll(?int $cityId, ?int $minRating): array;
    public function getOne(int $id): ?Attraction;
    public function create(Attraction $attraction): int;
    public function update(Attraction $attraction): void;
    public function delete(int $id): void;
}