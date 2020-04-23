<?php
declare(strict_types=1);

namespace App\Application\Actions\News;

use Psr\Http\Message\ResponseInterface as Response;

class NewsPaginationAction extends NewsAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $num = (int) $this->resolveArg('p');
        $news = $this->newsRepository->getNewsByPagiation($num);        
        return $this->respondWithData($news);
    }
}
