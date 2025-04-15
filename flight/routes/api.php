<?php
use App\Application\UseCases\CreateCityUseCase;
use App\Application\UseCases\DeleteCityUseCase;
use App\Application\UseCases\GetCitiesUseCase;
use App\Application\UseCases\GetCityUseCase;
use App\Application\UseCases\UpdateCityUseCase;
use App\Presentation\Controllers\CityController;

$getCityUseCase = new GetCityUseCase(Flight::cityRepository());
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