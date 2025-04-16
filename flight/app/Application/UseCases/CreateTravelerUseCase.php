<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\TravelerBadRequestException;
use App\Domain\Repositories\TravelerRepositoryInterface;
use App\Domain\Entities\Traveler;
class CreateTravelerUseCase{
    public function __construct(
        private readonly TravelerRepositoryInterface $repository,
    ){}

    /**
     * @throws TravelerBadRequestException
     */
    public function execute(string $name): int
    {
        $name = trim($name);
        if (empty($name)){
            throw new TravelerBadRequestException("Name can't be empty");
        }
        $traveler = new Traveler(null, $name);
        return $this->repository->create($traveler);
    }
}