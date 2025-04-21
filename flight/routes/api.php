<?php

use App\Application\UseCases\CreateAttractionUseCase;
use App\Application\UseCases\CreateCityUseCase;
use App\Application\UseCases\CreateRatingUseCase;
use App\Application\UseCases\CreateTravelerUseCase;
use App\Application\UseCases\DeleteAttractionUseCase;
use App\Application\UseCases\DeleteCityUseCase;
use App\Application\UseCases\DeleteTravelerUseCase;
use App\Application\UseCases\GetAttractionsUseCase;
use App\Application\UseCases\GetAttractionUseCase;
use App\Application\UseCases\GetCitiesUseCase;
use App\Application\UseCases\GetCityUseCase;
use App\Application\UseCases\GetRatingAttraction;
use App\Application\UseCases\GetRatingTraveler;
use App\Application\UseCases\GetTravelersUseCase;
use App\Application\UseCases\GetTravelerUseCase;
use App\Application\UseCases\GetVisitedSitiesTravelerUseCase;
use App\Application\UseCases\UpdateAttractionUseCase;
use App\Application\UseCases\UpdateCityUseCase;
use App\Application\UseCases\UpdateTravelerUseCase;
use App\Presentation\Controllers\AttractionController;
use App\Presentation\Controllers\CityController;
use App\Presentation\Controllers\RatingController;
use App\Presentation\Controllers\TravelerController;

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
    Flight::attractionRepository(),
    Flight::getAttractionUseCase(),
    Flight::getCityUseCase()
]);
Flight::register('deleteAttractionUseCase', DeleteAttractionUseCase::class, [
    Flight::attractionRepository(),
    Flight::getAttractionUseCase()
]);
Flight::register('attractionController', AttractionController::class, [
    Flight::getAttractionsUseCase(),
    Flight::getAttractionUseCase(),
    Flight::createAttractionUseCase(),
    Flight::updateAttractionUseCase(),
    Flight::deleteAttractionUseCase(),
    Flight::app()
]);

Flight::route('GET /attractions', [Flight::attractionController(), 'index']);
Flight::route('GET /attractions/@id:[0-9]+', [Flight::attractionController(), 'show']);
Flight::route('POST /attractions', [Flight::attractionController(), 'store']);
Flight::route('PUT /attractions/@id:[0-9]+', [Flight::attractionController(), 'update']);
Flight::route('DELETE /attractions/@id:[0-9]+', [Flight::attractionController(), 'destroy']);

Flight::register('getTravelersUseCase', GetTravelersUseCase::class, [Flight::travelerRepository()]);
Flight::register('getTravelerUseCase', GetTravelerUseCase::class, [Flight::travelerRepository()]);
Flight::register('createTravelerUseCase', CreateTravelerUseCase::class, [Flight::travelerRepository()]);
Flight::register('updateTravelerUseCase', UpdateTravelerUseCase::class, [
    Flight::travelerRepository(),
    Flight::getTravelerUseCase()
]);
Flight::register('deleteTravelerUseCase', DeleteTravelerUseCase::class, [
    Flight::travelerRepository(),
    Flight::getTravelerUseCase()
]);
Flight::register('getVisitedSitiesTravelerUseCase', GetVisitedSitiesTravelerUseCase::class, [
    Flight::travelerRepository(),
    Flight::getTravelerUseCase()
]);
Flight::register('travelerController', TravelerController::class, [
    Flight::getTravelersUseCase(),
    Flight::getTravelerUseCase(),
    Flight::createTravelerUseCase(),
    Flight::updateTravelerUseCase(),
    Flight::deleteTravelerUseCase(),
    Flight::getVisitedSitiesTravelerUseCase(),
    Flight::app()
]);

Flight::route('GET /travelers', [Flight::travelerController(), 'index']);
Flight::route('GET /travelers/@id:[0-9]+', [Flight::travelerController(), 'show']);
Flight::route('GET /travelers/@id:[0-9]+/visited-cities', [Flight::travelerController(), 'getVisitedCities']);
Flight::route('POST /travelers', [Flight::travelerController(), 'store']);
Flight::route('PUT /travelers/@id:[0-9]+', [Flight::travelerController(), 'update']);
Flight::route('DELETE /travelers/@id:[0-9]+', [Flight::travelerController(), 'destroy']);

Flight::register('createRatingUseCase', CreateRatingUseCase::class, [
    Flight::ratingRepository(),
    Flight::getAttractionUseCase(),
    Flight::getTravelerUseCase(),
]);
Flight::register('getRatingAttractionUseCase', GetRatingAttraction::class, [Flight::ratingRepository()]);
Flight::register('getRatingTravelerUseCase', GetRatingTraveler::class, [Flight::ratingRepository()]);
Flight::register('ratingController', RatingController::class, [
    Flight::createRatingUseCase(),
    Flight::getRatingAttractionUseCase(),
    Flight::getRatingTravelerUseCase(),
    Flight::app()
]);
Flight::route('POST /ratings', [Flight::ratingController(), 'store']);
Flight::route('GET /ratings/attraction/@id:[0-9]+', [Flight::ratingController(), 'getRatingAttraction']);
Flight::route('GET /ratings/traveler/@id:[0-9]+', [Flight::ratingController(), 'getRatingTraveler']);
