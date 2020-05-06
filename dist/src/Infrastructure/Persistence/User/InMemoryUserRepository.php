<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use Psr\Container\ContainerInterface;
use PDO;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private $users;
    private $service;

    public function __construct(ContainerInterface $c, PDO $pdo)
    {
        $this->service = new UserRepositoryService($pdo, $c->get('database')['dbname']);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        if (!isset($this->users[$id])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function findUser(String $username, String $password): User
    {
        return $this->service->getUser($username, $password);
    }
}
