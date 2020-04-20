<?php
declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Domain\News\NewsRepository;
use App\Domain\RepositoryService;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\News\InMemoryNewsRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        NewsRepository::class => \DI\autowire(InMemoryNewsRepository::class)
    ]);
};
