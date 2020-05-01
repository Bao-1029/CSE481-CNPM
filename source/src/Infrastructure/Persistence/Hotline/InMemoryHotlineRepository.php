<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Hotline;

use App\Domain\Hotline\Hotline;
use App\Domain\Hotline\HotlineNotFoundException;
use App\Domain\Hotline\HotlineRepository;
use Psr\Container\ContainerInterface;
use PDO;

class InMemoryHotlineRepository implements HotlineRepository
{
    /**
     * @var User[]
     */
    private $users;
    private $service;

    public function __construct(ContainerInterface $c, PDO $pdo)
    {
        $this->service = new HotlineRepositoryService($pdo, $c->get('database')['dbname']);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->service->getAllHotline();
    }

    /**
     * {@inheritdoc}
     */
    public function addHotline(String $name, String $phone_number)
    {
        return $this->service->insertHotline($name, $phone_number);
    }

    /**
     * {@inheritdoc}
     */
    public function editHotline(int $id, String $name, String $phone_number)
    {
        return $this->service->updateHotline($id, $name, $phone_number);
    }

    /**
     * {@inheritdoc}
     */
    public function removeHotline(int $id)
    {
        return $this->service->deleteHotline($id);
    }
}
