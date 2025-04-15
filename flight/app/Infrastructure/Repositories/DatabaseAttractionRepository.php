<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Attraction;
use App\Domain\Repositories\AttractionRepositoryInterface;

class DatabaseAttractionRepository implements AttractionRepositoryInterface {
    public function __construct(
        private \PDO $pdo
    ){}
    public function getAll(?int $cityId): array
    {
        $sql = "SELECT * FROM attraction";
        $params = [];
        if ($cityId !== null){
            $sql .= " WHERE city_id = :cityId";
            $params["cityId"] = $cityId;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $attraction = [];
        while($row = $query->fetch()){
            $attraction[] = new Attraction(
                $row['id'],
                $row['name'],
                $row['distance_from_center'],
                $row['city_id']
            );
        }
        return $attraction;
    }
    public function getOne(int $id): ?Attraction
    {
        $query = $this->pdo->prepare("SELECT * FROM attraction WHERE id = :id");
        $query->execute([':id' => $id]);
        $row = $query->fetch();
        if (!$row){
            return null;
        }
        return new Attraction($row['id'], $row['name'], $row['distance_from_center'], $row['city_id']);
    }
    public function create(Attraction $attraction): int
    {
        $query = $this->pdo->prepare("INSERT INTO attraction (name, distance_from_center, city_id) VALUES (:name, :distance_from_center, :city_id)");
        $query->execute([
            ':name' => $attraction->name,
            ':distance_from_center' => $attraction->distance_from_center,
            ':city_id' => $attraction->city_id
        ]);
        return (int)$this->pdo->lastInsertId();
    }
    public function update(Attraction $attraction): void
    {
        $query = $this->pdo->prepare("UPDATE attraction SET name = :name, distance_from_center = :distance_from_center, city_id = :city_id WHERE id = :id");
        $query->execute([
            ':id' => $attraction->id,
            ':name' => $attraction->name,
            ':distance_from_center' => $attraction->distance_from_center,
            ':city_id' => $attraction->city_id
        ]);
    }
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM attraction WHERE id = :id");
        $query->execute([':id' => $id]);
    }
}