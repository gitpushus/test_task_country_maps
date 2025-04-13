<?php
return [
    'adapter' => 'mysql',
	'host' => 'mariadb',
	'name' => $_ENV['DB_NAME'] ?: 'my_database',
    'user' => $_ENV['DB_USER'] ?: 'root',
    'pass' => $_ENV['DB_PASSWORD'] ?: '1234',
    'port' => 3306,
	'charset' => 'utf8mb4',
];