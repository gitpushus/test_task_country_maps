<?php
namespace App\Presentation\Controllers;

use App\Application\UseCases\CreateCityUseCase;
use App\Application\UseCases\DeleteCityUseCase;
use App\Application\UseCases\GetCitiesUseCase;
use App\Application\UseCases\GetCityUseCase;
use App\Application\UseCases\GetTravelersCityUseCase;
use App\Application\UseCases\UpdateCityUseCase;
use App\Domain\Exceptions\CityBadRequestException;
use App\Domain\Exceptions\CityNotFoundException;
use flight\Engine;
class CityController
{
    public function __construct(
        private GetCitiesUseCase $getCitiesUseCase,
        private GetCityUseCase $getCityUseCase,
        private CreateCityUseCase $createCityUseCase,
        private UpdateCityUseCase $updateCityUseCase,
        private DeleteCityUseCase $deleteCityUseCase,
        private GetTravelersCityUseCase $getTravelersCityUseCase,
        private Engine $app
    ) {}
    public function index():void
    {
        $cities = $this->getCitiesUseCase->execute();
        $this->app->json($cities, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
    }
    public function show(int $id):void
    {
        try{
            $city = $this->getCityUseCase->execute($id);
            $this->app->json($city, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
        }catch (CityNotFoundException $e){
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
                throw new CityBadRequestException("City name is required");
            }
            $id = $this->createCityUseCase->execute($data['name']);
            $this->app->json(['id' => $id]);
        }catch(CityBadRequestException $e){
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
                throw new CityBadRequestException("City name is required");
            }
            $this->updateCityUseCase->execute($id, $data['name']);
            $this->app->json(['success' => true]);
        }catch(CityBadRequestException|CityNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        } catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function destroy(int $id):void
    {
        try{
            $this->deleteCityUseCase->execute($id);
            $this->app->json(['success' => true]);
        }catch(CityNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function getTravelers(int $id):void
    {
        try{
            $travelers = $this->getTravelersCityUseCase->execute($id);
            $this->app->json($travelers);
        }catch(CityNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
}