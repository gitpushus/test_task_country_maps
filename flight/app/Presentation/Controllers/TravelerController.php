<?php
namespace App\Presentation\Controllers;

use App\Application\UseCases\CreateTravelerUseCase;
use App\Application\UseCases\DeleteTravelerUseCase;
use App\Application\UseCases\GetTravelersUseCase;
use App\Application\UseCases\GetTravelerUseCase;
use App\Application\UseCases\GetVisitedSitiesTravelerUseCase;
use App\Application\UseCases\UpdateTravelerUseCase;
use App\Domain\Exceptions\TravelerBadRequestException;
use App\Domain\Exceptions\TravelerNotFoundException;
use flight\Engine;

class TravelerController
{
    public function __construct(
        private GetTravelersUseCase $getTravelersUseCase,
        private GetTravelerUseCase $getTravelerUseCase,
        private CreateTravelerUseCase $createTravelerUseCase,
        private UpdateTravelerUseCase $updateTravelerUseCase,
        private DeleteTravelerUseCase $deleteTravelerUseCase,
        private GetVisitedSitiesTravelerUseCase $getVisitedSitiesTravelerUseCase,
        private Engine $app
    ){}
    public function index():void
    {
        $travelers = $this->getTravelersUseCase->execute();
        $this->app->json($travelers, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
    }
    public function show(int $id):void
    {
        try{
            $traveler = $this->getTravelerUseCase->execute($id);
            $this->app->json($traveler, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
        }catch (TravelerNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function store():void
    {
        try{
            $data = $this->app->request()->data;
            if (!isset($data['name'])){
                throw new TravelerBadRequestException("Traveler name is required");
            }
            $id = $this->createTravelerUseCase->execute($data['name']);
            $this->app->json(['id' => $id]);
        }catch(TravelerBadRequestException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function update(int $id):void
    {
        try{
            $body = $this->app->request()->getBody();
            $data = json_decode($body, true);
            if (empty($data)) {
                throw new \Exception();
            }
            if (!isset($data['name'])){
                throw new TravelerBadRequestException("Traveler name is required");
            }
            $this->updateTravelerUseCase->execute($id, $data['name']);
            $this->app->json(['success' => true]);
        }catch(TravelerBadRequestException|TravelerNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        } catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function destroy(int $id):void
    {
        try{
            $this->deleteTravelerUseCase->execute($id);
            $this->app->json(['success' => true]);
        }catch(TravelerNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function getVisitedCities(int $id): void{
        try{
            $cities = $this->getVisitedSitiesTravelerUseCase->execute($id);
            $this->app->json($cities);
        }catch (TravelerNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
}
