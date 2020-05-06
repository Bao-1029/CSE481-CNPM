<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Factory\ResponseFactory;

class UserLogoutAction extends UserAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        if ($this->session->exists('userId')) {
            $this->session->clear();

            // deleting the whole session
            // destroys the session data that is stored in the session storage (e.g. the session file in the file system)

            // https://www.php.net/session_destroy
            // If a cookie is used to propagate the session ID (default behavior), then the session cookie must be deleted. setcookie() may be used for that.
            // echo ini_get("session.use_cookies"); trả về 1
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 4200,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }

            if (session_status() == PHP_SESSION_ACTIVE)
                $this->session->destroy();
        }

        return $this->response->withStatus(302);
    }
}