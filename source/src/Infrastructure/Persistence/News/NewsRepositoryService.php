<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\RepositoryService;

use PDO;
use PDOException;

class NewsRepositoryService extends RepositoryService {
    private const SELECT_QUERY = "CALL sp_select_news (:offset, :limt)";
    private const INSERT_QUERY = "CALL sp_insert_news (:title, :link, :source, :imgUri)";
    private const GET_QUERY = "SELECT f_get_latest_title_news()";
    private const COUNT_QUERY = "SELECT count(*) FROM news_detail";

    public function insertNews(String $title, String $link, String $source, String $imgUri): bool
    {
        try {
            if ($stmt = $this->pdo->prepare(self::INSERT_QUERY)) {
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
            $result = $this->pdo->query(self::GET_QUERY);
            return $result->fetch()['title'];
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function getTotalNumberOfNews()
    {
        try {
            return $this->pdo->query(self::COUNT_QUERY);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }

    public function selectWithCond(int $offset, int $limt)
    {
        try {
            if ($stmt = $this->pdo->prepare(self::SELECT_QUERY)) {
                $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
                $stmt->bindParam(":limt", $limt, PDO::PARAM_INT);

                if ($stmt->execute())
                    return $stmt->fetchAll(PDO::FETCH_CLASS, "News");
            }
            return null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), 1);
        }
    }
}
?>