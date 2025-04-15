<?php
namespace App\Application\UseCases;
use App\Domain\Entities\Attraction;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Repositories\AttractionRepositoryInterface;
class GetAttractionUseCase{
    public function __construct(
        private readonly AttractionRepositoryInterface $repository
    ){}
    public function execute(int $id): Attraction
    {
        $attraction = $this->repository->getOne($id);
        if ($attraction === null){
            throw new AttractionNotFoundException($id);
        }
        return new Attraction(
            $attraction->id,
            $attraction->name,
            $attraction->distance_from_center,
            $attraction->city_id
        );
    }
}