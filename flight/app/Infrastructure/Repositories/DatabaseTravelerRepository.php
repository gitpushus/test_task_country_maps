<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Traveler;
use App\Domain\Repositories\TravelerRepositoryInterface;

class DatabaseTravelerRepository implements TravelerRepositoryInterface {
    public function __construct(
        private \PDO $pdo
    ){}
    public function getAll(): array
    {
        $query = $this->pdo->prepare("SELECT * FROM traveler");
        $query->execute();
        $travelers = [];
        while($row = $query->fetch()){
            $travelers[] = new Traveler($row["id"], $row["name"]);
        }
        return $travelers;
    }
    public function getOne(int $id): ?Traveler
    {
        $query = $this->pdo->prepare("SELECT * FROM traveler WHERE id = :id");
        $query->execute([':id' => $id]);
        $row = $query->fetch();
        if (!$row){
            return null;
        }
        return new Traveler($row['id'], $row['name']);
    }
    public function create(Traveler $traveler): int
    {
        $query = $this->pdo->prepare("INSERT INTO traveler (name) VALUES (:name)");
        $query->execute([":name" => $traveler->name]);
        return (int)$this->pdo->lastInsertId();
    }
    public function update(Traveler $traveler): void
    {
        $query = $this->pdo->prepare("UPDATE traveler SET name = :name WHERE id = :id");
        $query->execute([":name" => $traveler->name, ":id" => $traveler->id]);
    }
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM traveler WHERE id = :id");
        $query->execute([":id" => $id]);
    }
}