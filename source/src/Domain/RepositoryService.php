<?php
declare(strict_types=1);

namespace App\Domain;

use PDO;

abstract class RepositoryService {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
}