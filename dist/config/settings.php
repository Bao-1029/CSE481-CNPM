<?php
use Monolog\Logger;

return [
    'displayErrorDetails' => true, // Should be set to false in production
    'logger' => [
        'name' => 'slim-app',
        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../storage/logs/app.log',
        'level' => Logger::DEBUG,
    ],
];
?>