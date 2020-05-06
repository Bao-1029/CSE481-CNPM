<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class AddHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $data = $this->request->getParsedBody();
        $name = (String) $data['name'];
        $phone_number = (string) $data['phone_number'];

        $result = $this->hotlineRepository->addHotline($name, $phone_number);
        
        return $this->respondWithData($result);
    }
}
