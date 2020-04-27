<?php
declare(strict_types=1);

namespace App\Domain;

use PDO;

abstract class RepositoryService {
    protected $pdo;
    protected $db_name;

    public function __construct(PDO $pdo, String $db_name) {
        $this->pdo = $pdo;
        $this->db_name = $db_name;
    }
}
