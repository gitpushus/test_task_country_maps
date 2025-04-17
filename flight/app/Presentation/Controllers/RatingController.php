<?php
namespace App\Presentation\Controllers;
use App\Application\UseCases\CreateRatingUseCase;
use App\Application\UseCases\GetRatingAttraction;
use App\Application\UseCases\GetRatingTraveler;
use App\Domain\Dto\RatingDto;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Exceptions\RatingBadRequestException;
use App\Domain\Exceptions\TravelerNotFoundException;
use flight\Engine;

class RatingController
{
    public function __construct(
        private CreateRatingUseCase  $createRatingUseCase,
        private GetRatingAttraction $getRatingAttraction,
        private GetRatingTraveler $getRatingTraveler,
        private Engine $app
    ){}
    public function store():void
    {
        try{
            $data = $this->app->request()->data;
            $ratingDto = new RatingDto(
                $data['traveler_id'],
                $data['attraction_id'],
                $data['score'],
            );
            $id = $this->createRatingUseCase->execute($ratingDto);
            $this->app->json(['id' => $id]);
        }catch(RatingBadRequestException|AttractionNotFoundException|TravelerNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function getRatingAttraction(int $attraction_id):void
    {
        try{
            $ratings = $this->getRatingAttraction->execute($attraction_id);
            $this->app->json(['ratings' => $ratings]);
        }catch(\Exception $e){
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function getRatingTraveler(int $traveler_id):void
    {
        try{
            $ratings = $this->getRatingTraveler->execute($traveler_id);
            $this->app->json(['ratings' => $ratings]);
        }catch(\Exception $e){
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
}