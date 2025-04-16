<?php
namespace App\Domain\Repositories;
use App\Domain\Entities\Traveler;
interface TravelerRepositoryInterface {
    public function getAll(): array;
    public function getOne(int $id): ?Traveler;
    public function create(Traveler $traveler): int;
    public function update(Traveler $traveler): void;
    public function delete(int $id): void;
}