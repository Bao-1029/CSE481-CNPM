<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class RemoveHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $data = $this->request->getParsedBody();
        $id = (int) $data['id'];
        
        $result = $this->hotlineRepository->removeHotline($id);
        
        return $this->respondWithData($result);
    }
}
