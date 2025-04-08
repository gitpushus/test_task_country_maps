<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'adapter' => 'mysql',
	'host' => 'mariadb',
	'name' => getenv('DB_NAME') ?: 'my_database',
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASSWORD') ?: '1234',
    'port' => 3306,
	'charset' => 'utf8mb4',
];