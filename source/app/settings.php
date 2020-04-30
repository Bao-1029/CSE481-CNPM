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
            'dbname' => 'cnpm_coronavirus',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
        ],
        'resources' => [
            'template' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../resources/templates',
            'views' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../resources/views',
        ],
        'page_meta_data' => [
            'home' => [
                'title' => 'Trang chủ - Thống kê | Việt Nam - Coronavirus',
                'page' => 'home',
            ],
            'news' => [
                'title' => 'Tin tức | Việt Nam - Coronavirus',
                'page' => 'news',
            ],
            'symptoms' => [
                'title' => 'Biểu hiện bệnh | Việt Nam - Coronavirus',
                'page' => 'symptoms',
            ],
            'precaution' => [
                'title' => 'Cách phòng tránh | Việt Nam - Coronavirus',
                'page' => 'precaution',
            ],
        ]
    ]);
};
