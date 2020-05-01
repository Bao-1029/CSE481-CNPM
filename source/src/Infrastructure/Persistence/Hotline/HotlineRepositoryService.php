<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Hotline;

use App\Domain\RepositoryService;

use PDO;
use PDOException;

class HotlineRepositoryService extends RepositoryService {
    private function QUERY_ALL() {
        return 'SELECT * FROM ' . $this->db_name . '.hospital_hotlines';
    }
    private function INSERT_QUERY() {
        return 'INSERT INTO ' . $this->db_name . '.hospital_hotlines VALUE (NULL, :name, :phone_number)';
    }
    private function UPDATE_QUERY() {
        return 'UPDATE ' . $this->db_name . '.hospital_hotlines SET name = :name, phone_number = :phone_number) WHERE id = :id';
    }
    private function DELETE_QUERY() {
        return 'DELETE FROM ' . $this->db_name . '.hospital_hotlines WHERE id = :id';
    }

    public function getAllHotline()
    {
        try {
            if ($stmt = $this->pdo->prepare($this->QUERY_ALL())) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, \App\Domain\Hotline\Hotline::class);

                if ($stmt->execute())
                    return $stmt->fetchAll();
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function insertHotline(String $name, String $phone_number)
    {
        try {
            if ($stmt = $this->pdo->prepare($this->INSERT_QUERY())) {
                $stmt->bindParam(":name", $name, PDO::PARAM_STR, 100);
                $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR, 20);

                if ($stmt->execute())
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function updateHotline(int $id, String $name, String $phone_number)
    {
        try {
            if ($stmt = $this->pdo->prepare($this->UPDATE_QUERY())) {
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->bindParam(":name", $name, PDO::PARAM_STR, 100);
                $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR, 20);

                if ($stmt->execute())
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function deleteHotline(int $id)
    {
        try {
            if ($stmt = $this->pdo->prepare($this->DELETE_QUERY())) {
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                if ($stmt->execute())
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}
?>