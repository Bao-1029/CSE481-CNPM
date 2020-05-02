<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use Psr\Http\Message\ResponseInterface as Response;

class AddHotlineAction extends HotlineAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $name = (String) $this->resolveArg('name');
        $phone_number = (string) $this->resolveArg('phone_number');

        $result = $this->hotlineRepository->addHotline($name, $phone_number);
        
        return $this->respondWithData($result);
    }
}
