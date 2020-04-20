<?php
declare(strict_types=1);

namespace App\Application\Actions\News;

use Psr\Http\Message\ResponseInterface as Response;

class HeadlinesAction extends NewsAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $news = $this->newsRepository->getHeadlines();
        $this->logger->info('News list was viewed');
        
        return $this->respondWithData($news);
    }
}
?>