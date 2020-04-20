<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../storage/logs/app.log',
                'level' => Logger::DEBUG,
            ],
        ],
        'storage' => [
            'news_path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../storage/news',
            'config' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../config/newsSerivce.ini',
        ],
        'database' => [
            'host' => 'localhost',
            'dbname' => '',
            'user' => 'root',
            'password' => 'cnpm_coronavirus'
        ],
    ]);
};
