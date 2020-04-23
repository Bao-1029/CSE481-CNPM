<?php
declare(strict_types=1);

namespace App\Application\Actions\News;

use Psr\Http\Message\ResponseInterface as Response;

class AllNewsAction extends NewsAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $news = $this->newsRepository->getNews();        
        return $this->respondWithData($news);
    }
}
