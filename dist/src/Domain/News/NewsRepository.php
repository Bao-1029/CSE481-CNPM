<?php
declare(strict_types=1);

namespace App\Domain\News;

interface NewsRepository {
    /**
     * @return News[]
     */
    public function getNews(): array;

    /**
     * @return News[]
     */
    public function getHeadlines(): array;

    /**
     * @param int $num pagination number
     * @return News[]
     * @throws NewsNotFoundException
     */
    public function getNewsByPagiation(int $num): array;
}
?>
