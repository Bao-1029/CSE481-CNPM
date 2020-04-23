<?php
return [
    'news_path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../storage/news',
];
?>