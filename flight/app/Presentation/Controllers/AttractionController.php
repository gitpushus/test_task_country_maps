<?php
namespace App\Presentation\Controllers;

use App\Application\UseCases\CreateAttractionUseCase;
use App\Application\UseCases\DeleteAttractionUseCase;
use App\Application\UseCases\GetAttractionsUseCase;
use App\Application\UseCases\GetAttractionUseCase;
use App\Application\UseCases\UpdateAttractionUseCase;
use App\Domain\Dto\CreateAttractionDto;
use App\Domain\Dto\UpdateAttractionDto;
use App\Domain\Exceptions\AttractionNotFoundException;
use App\Domain\Exceptions\CityNotFoundException;
use flight\Engine;

class AttractionController{
    public function __construct(
        private GetAttractionsUseCase $getAttractionsUseCase,
        private GetAttractionUseCase $getAttractionUseCase,
        private CreateAttractionUseCase $createAttractionUseCase,
        private UpdateAttractionUseCase $updateAttractionUseCase,
        private DeleteAttractionUseCase $deleteAttractionUseCase,
        private Engine $app
    ) {}
    public function index():void
    {
        $attractions = $this->getAttractionsUseCase->execute();
        $this->app->json($attractions, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
    }
    public function show(int $id):void
    {
        try{
            $city = $this->getAttractionUseCase->execute($id);
            $this->app->json($city, 200, true, 'utf-8', JSON_UNESCAPED_UNICODE);
        }catch (AttractionNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function store():void
    {
        try{
            $data = $this->app->request()->data;
            $attractionDto = new CreateAttractionDto(
                $data['name'],
                $data['distance_from_center'],
                $data['city_id'],
            );
            $id = $this->createAttractionUseCase->execute($attractionDto);
            $this->app->json(['id' => $id]);
        }catch(CityNotFoundException $e){
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
            $attractionDto = new UpdateAttractionDto(
                $id,
                $data['name'] ?? null,
                $data['distance_from_center'] ?? null,
                $data['city_id'] ?? null,
            );
            $this->updateAttractionUseCase->execute($attractionDto);
            $this->app->json(['success' => true]);
        }catch(AttractionNotFoundException|CityNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        } catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
    public function destroy(int $id):void
    {
        try{
            $this->deleteAttractionUseCase->execute($id);
            $this->app->json(['success' => true]);
        }catch(AttractionNotFoundException $e){
            $this->app->halt($e->getCode(), json_encode(['error' => $e->getMessage()]));
        }catch (\Exception $e) {
            $this->app->halt(500, json_encode(['error' => 'Internal Server Error']));
        }
    }
}