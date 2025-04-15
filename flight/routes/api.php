<?php

use App\Application\UseCases\CreateAttractionUseCase;
use App\Application\UseCases\CreateCityUseCase;
use App\Application\UseCases\DeleteAttractionUseCase;
use App\Application\UseCases\DeleteCityUseCase;
use App\Application\UseCases\GetAttractionsUseCase;
use App\Application\UseCases\GetAttractionUseCase;
use App\Application\UseCases\GetCitiesUseCase;
use App\Application\UseCases\GetCityUseCase;
use App\Application\UseCases\UpdateAttractionUseCase;
use App\Application\UseCases\UpdateCityUseCase;
use App\Presentation\Controllers\CityController;

Flight::register('getCitiesUseCase', GetCitiesUseCase::class, [Flight::cityRepository()]);
Flight::register('getCityUseCase', GetCityUseCase::class, [Flight::cityRepository()]);
Flight::register('createCityUseCase', CreateCityUseCase::class, [Flight::cityRepository()]);
Flight::register('updateCityUseCase', UpdateCityUseCase::class, [
    Flight::cityRepository(),
    Flight::getCityUseCase()
]);
Flight::register('deleteCityUseCase', DeleteCityUseCase::class, [
    Flight::cityRepository(),
    Flight::getCityUseCase()
    ]);
Flight::register('cityController', CityController::class, [
    Flight::getCitiesUseCase(),
    Flight::getCityUseCase(),
    Flight::createCityUseCase(),
    Flight::updateCityUseCase(),
    Flight::deleteCityUseCase(),
    Flight::app()
]);

Flight::route('GET /cities', [Flight::cityController(), 'index']);
Flight::route('GET /cities/@id:[0-9]+', [Flight::cityController(), 'show']);
Flight::route('POST /cities', [Flight::cityController(), 'store']);
Flight::route('PUT /cities/@id:[0-9]+', [Flight::cityController(), 'update']);
Flight::route('DELETE /cities/@id:[0-9]+', [Flight::cityController(), 'destroy']);

Flight::register('getAttractionsUseCase', GetAttractionsUseCase::class, [Flight::attractionRepository()]);
Flight::register('getAttractionUseCase', GetAttractionUseCase::class, [Flight::attractionRepository()]);
Flight::register('createAttractionUseCase', CreateAttractionUseCase::class, [
    Flight::attractionRepository(),
    Flight::getCityUseCase()
]);
Flight::register('updateAttractionUseCase', UpdateAttractionUseCase::class, [
    Flight::cityRepository(),
    Flight::getAttractionUseCase(),
    Flight::getCityUseCase()
]);
Flight::register('deleteCityUseCase', DeleteAttractionUseCase::class, [
    Flight::cityRepository(),
    Flight::getAttractionUseCase()
]);
Flight::register('attractionController', CityController::class, [
    Flight::getAttractionsUseCase(),
    Flight::getAttractionUseCase(),
    Flight::createAttractionseUseCase(),
    Flight::updateAttractionseUseCase(),
    Flight::deleteAttractionseUseCase(),
    Flight::app()
]);

Flight::route('GET /attractions', [Flight::attractionController(), 'index']);
Flight::route('GET /attractions/@id:[0-9]+', [Flight::attractionController(), 'show']);
Flight::route('POST /attractions', [Flight::attractionController(), 'store']);
Flight::route('PUT /attractions/@id:[0-9]+', [Flight::attractionController(), 'update']);
Flight::route('DELETE /attractions/@id:[0-9]+', [Flight::attractionController(), 'destroy']);
