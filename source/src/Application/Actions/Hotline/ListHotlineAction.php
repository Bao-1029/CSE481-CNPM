<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class ListHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $hotlines = $this->hotlineRepository->findAll();
        return $this->respondWithData($hotlines);
    }
}
