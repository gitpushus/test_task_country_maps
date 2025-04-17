<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\RatingRepositoryInterface;
use App\Domain\Entities\Rating;

class DatabaseRatingRepository implements RatingRepositoryInterface
{
    public function __construct(
        private \PDO $pdo
    ){}

    public function create(Rating $rating): int
    {
        $query = $this->pdo->prepare("INSERT INTO rating (traveler_id, attraction_id, score) VALUES (:traveler_id, :attraction_id, :score)");
        $query->execute([
            ':traveler_id' => $rating->traveler_id,
            ':attraction_id' => $rating->attraction_id,
            ':score' => $rating->score
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function getRatingAttraction(int $attraction_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM rating WHERE attraction_id = :attraction_id");
        $query->execute([':attraction_id' => $attraction_id]);
        $ratings = [];
        while($row = $query->fetch()){
            $ratings[] = $row['score'];
        }
        return $ratings;
    }

    public function getRatingTraveler(int $traveler_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM rating WHERE traveler_id = :traveler_id");
        $query->execute([':traveler_id' => $traveler_id]);
        $ratings = [];
        while($row = $query->fetch()){
            $ratings[] = $row['score'];
        }
        return $ratings;
    }
}