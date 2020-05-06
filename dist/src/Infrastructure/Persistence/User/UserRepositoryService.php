<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\RepositoryService;

use PDO;
use PDOException;

class UserRepositoryService extends RepositoryService {
    private function QUERY_AN_USER() {
        return 'SELECT * FROM ' . $this->db_name . '.users WHERE userName = :userName';
    }

    public function getUser(String $userName)
    {
        try {
            if ($stmt = $this->pdo->prepare($this->QUERY_AN_USER())) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, \App\Domain\User\User::class);
                $stmt->bindParam(":userName", $userName, PDO::PARAM_STR, 25);

                if ($stmt->execute())
                    return $stmt->fetch();
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}
?>