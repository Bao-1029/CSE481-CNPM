<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class EditHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $data = $this->request->getParsedBody();
        $id = (int) $data['id'];
        $name = (String) $data['name'];
        $phone_number = (string) $data['phone_number'];

        $result = $this->hotlineRepository->editHotline($id, $name, $phone_number);
        
        return $this->respondWithData($result);
    }
}
