<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\City;
use App\Domain\Repositories\CityRepositoryInterface;

class DatabaseCityRepository implements CityRepositoryInterface
{
    public function __construct(
        private \PDO $pdo
    ){}
    public function getAll(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM city");
        $query->execute();
        $cities = [];
        while($row = $query->fetch()){
            $cities[] = new City(
                $row['id'],
                $row['name']
            );
        }
        return $cities;
    }
    public function getOne(int $id): ?City
    {
        $query = $this->pdo->prepare("SELECT * FROM city WHERE id = :id");
        $query->execute([':id' => $id]);
        $row = $query->fetch();
        if (!$row){
            return null;
        }
        return new City($row['id'], $row['name']);
    }
    public function create(City $city): int
    {
        $query = $this->pdo->prepare("INSERT INTO city (name) VALUES (:name)");
        $query->execute([':name' => $city->name]);
        return (int)$this->pdo->lastInsertId();
    }
    public function update(City $city): void
    {
        $query = $this->pdo->prepare("UPDATE city SET name = :name WHERE id = :id");
        $query->execute([':name' => $city->name, ':id' => $city->id]);
    }
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM city WHERE id = :id");
        $query->execute([':id' => $id]);
    }
}