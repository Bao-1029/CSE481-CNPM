<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\UserStatusException;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserPasswordException;
use Psr\Http\Message\ResponseInterface as Response;

class UserLoginAction extends UserAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $data = $this->request->getParsedBody();
        $username = base64_decode((String) $data['username']);
        $password = base64_decode((string) $data['password']);
        $user = $this->userRepository->findUser($username, $password);

        if ($user)
        {
            if (!password_verify($password, $user->getPassword()))
                throw new UserPasswordException();
            if ($user->getStatus() == false)
                throw new UserStatusException();
            
            $this->session->set('userId', $user->getId());
            $this->session->set('username', $user->getUsername());
            $this->session->set('level', $user->getLevel());
            $this->session->set('status', $user->getStatus());
        }
        else
            throw new UserNotFoundException();

        return $this->response->withStatus(302);
    }
}