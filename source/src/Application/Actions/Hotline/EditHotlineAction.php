<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class EditHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $id = (int) $this->resolveArg('id');
        $name = (String) $this->resolveArg('name');
        $phone_number = (string) $this->resolveArg('phone_number');

        $result = $this->hotlineRepository->editHotline($id, $name, $phone_number);
        
        return $this->respondWithData($result);
    }
}
