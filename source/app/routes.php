<?php
declare(strict_types=1);

use App\Application\Actions\News\HeadlinesAction;
use App\Application\Actions\News\NewsPaginationAction;
use App\Application\Actions\News\AllNewsAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/api/news', function (Group $group) {
        /**
         * Route for /api/news/all
         * Get all news (when page laod in the first time)
         */
        $group->get('/all', AllNewsAction::class);

        /**
         * Route for /api/news/headlines
         */
        $group->get('/headlines', HeadlinesAction::class);

        /**
         * Route for /api/news/{p}
         * Get news by pagination number
         */
        $group->get('/{p}', NewsPaginationAction::class);
        /* OLD
        $group->map(['GET', 'POST'], '/[{p}]', function (Request $request, Response $response, $args) {
            $data = $this->;
            $result = json_encode($data);

            $response->getBody()->write($result);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }); */
    });
};
