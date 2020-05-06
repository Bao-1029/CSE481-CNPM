<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\RepositoryService;

use PDO;
use PDOException;

class NewsRepositoryService extends RepositoryService {
    private function SELECT_QUERY() {
        return 'CALL ' . $this->db_name . '.sp_select_news (:offset, :limt)';
    }
    private function INSERT_QUERY() {
        return 'CALL ' . $this->db_name . '.sp_insert_news (:title, :link, :source, :imgUri)';
    }
    private function GET_QUERY () {
        return 'SELECT ' . $this->db_name . '.f_get_latest_title_news()';
    }
    private function COUNT_QUERY() {
        return 'SELECT count(*) as total FROM ' . $this->db_name . '.news_detail';
    }

    public function insertNews(String $title, String $link, String $source, String $imgUri): bool
    {
        try {
            if ($stmt = $this->pdo->prepare($this->INSERT_QUERY())) {
                $stmt->bindParam(":title", $title, PDO::PARAM_STR, 300);
                $stmt->bindParam(":link", $link, PDO::PARAM_STR, 3000);
                $stmt->bindParam(":source", $source, PDO::PARAM_STR);
                $stmt->bindParam(":imgUri", $imgUri, PDO::PARAM_STR, 3000);

                if ($stmt->execute())
                    return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function getLatestTitleNews(): String
    {
        try {
            $stmt = $this->pdo->query($this->GET_QUERY());
            $news = array_values($stmt->fetch(PDO::FETCH_ASSOC))[0];
            return $news ? $news : '';
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function getTotalNumberOfNews(): int
    {
        try {
            $stmt = $this->pdo->query($this->COUNT_QUERY());
            $num = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            return $num;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function selectWithCond(int $offset, int $limt)
    {
        try {
            if ($stmt = $this->pdo->prepare($this->SELECT_QUERY())) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmt->bindParam(":limt", $limt, PDO::PARAM_INT);

                if ($stmt->execute())
                    return $stmt->fetchAll();
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}
?>