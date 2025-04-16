<?php
namespace App\Application\UseCases;
use App\Domain\Exceptions\TravelerBadRequestException;
use App\Domain\Exceptions\TravelerNotFoundException;
use App\Domain\Repositories\TravelerRepositoryInterface;
use App\Domain\Entities\Traveler;

class UpdateTravelerUseCase
{
    public function __construct(
        private readonly TravelerRepositoryInterface $repository,
        private readonly GetTravelerUseCase $getTravelerUseCase,
    ){}

    /**
     * @throws TravelerNotFoundException
     * @throws TravelerBadRequestException
     */
    public function execute(int $id, string $name):void
    {
        $name = trim($name);
        if (empty($name)){
            throw new TravelerBadRequestException("Name can't be empty");
        }
        $traveler = $this->getTravelerUseCase->execute($id);
        $new_traveler = new Traveler($traveler->id, $name);
        $this->repository->update($new_traveler);
    }
}