<?php
require __DIR__ . '/../vendor/autoload.php';
$dbConfig = require __DIR__ . '/database.php';

use App\Infrastructure\Repositories\DatabaseAttractionRepository;
use App\Infrastructure\Repositories\DatabaseCityRepository;
use App\Infrastructure\Repositories\DatabaseTravelerRepository;

Flight::register('db', PDO::class, [
    'mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['name'],
    $dbConfig['user'],
    $dbConfig['pass'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
]);
Flight::register('cityRepository', DatabaseCityRepository::class, [Flight::db()]);
Flight::register('attractionRepository', DatabaseAttractionRepository::class, [Flight::db()]);
Flight::register('travelerRepository', DatabaseTravelerRepository::class, [Flight::db()]);
require __DIR__ . '/../routes/api.php';