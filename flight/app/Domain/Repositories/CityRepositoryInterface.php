<?php
namespace App\Domain\Repositories;
use App\Domain\Entities\City;
interface CityRepositoryInterface {
    public function getAll(): array;
    public function getOne(int $id): ?City;
    public function create(City $city): int;
    public function update(City $city): void;
    public function delete(int $id): void;
}
