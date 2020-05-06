<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response as Psr7Response;
use SlimSession\Helper;

class AuthMiddleware implements Middleware
{
    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $session = new Helper;
        if ($request->getMethod() != 'GET' && !$session->exists('userId')) {
            $response = new Psr7Response();
            return $response->withHeader('Location', 'login');
            // throw new HttpUnauthorizedException($this->request);
        }

        return $handler->handle($request);
    }
}
