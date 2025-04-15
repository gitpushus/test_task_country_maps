<?php
$dbConfig = require __DIR__ . '/config/database.php';
return
[
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => $dbConfig,
    ],
    'version_order' => 'creation'
];
