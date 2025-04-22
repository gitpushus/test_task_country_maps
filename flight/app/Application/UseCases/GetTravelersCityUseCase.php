<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\CityNotFoundException;
use App\Domain\Repositories\CityRepositoryInterface;

class GetTravelersCityUseCase{
    public function __construct(
        private readonly CityRepositoryInterface $repository
    ){}

    /**
     * @throws CityNotFoundException
     */
    public function execute(int $id): array
    {
        $city = $this->repository->getOne($id);
        if (is_null($city)) {
            throw new CityNotFoundException($id);
        }
        return $this->repository->getTravelers($id);
    }
}