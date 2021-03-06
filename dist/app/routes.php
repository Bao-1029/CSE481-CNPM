<?php
declare(strict_types=1);

use App\Application\Actions\AdminPage\DashboardPageAction;
use App\Application\Actions\AdminPage\LoginPageAction;
use App\Application\Actions\Hotline\AddHotlineAction;
use App\Application\Actions\Hotline\EditHotlineAction;
use App\Application\Actions\Hotline\ListHotlineAction;
use App\Application\Actions\Hotline\RemoveHotlineAction;
use App\Application\Actions\User\UserLoginAction;
use App\Application\Actions\User\UserLogoutAction;
use App\Application\Actions\News\HeadlinesAction;
use App\Application\Actions\News\NewsPaginationAction;
use App\Application\Actions\News\AllNewsAction;
use App\Application\Actions\Page\HomePageAction;
use App\Application\Actions\Page\NewsPageAction;
use App\Application\Actions\Page\SymptomsPageAction;
use App\Application\Actions\Page\PrecautionPageAction;
use App\Application\Actions\Statistics\StatisticsAction;
use App\Application\Middleware\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Exception\HttpNotFoundException;


return function (App $app) {
    /* $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    }); */
    $app->group('/', function (Group $group) {
        // Allow preflight requests
        // Due to the behaviour of browsers when sending a request,
        // you must add the OPTIONS method. Read about preflight.
        $group->options('trang-chu', function (Request $request, Response $response): Response {
            // Do nothing here. Just return the response.
            return $response;
        });
        $group->get('trang-chu', HomePageAction::class);
        $group->get('tin-tuc', NewsPageAction::class);
        $group->get('bieu-hien-benh', SymptomsPageAction::class);
        $group->get('cach-phong-tranh', PrecautionPageAction::class);
        $group->get('login', LoginPageAction::class);
        $group->get('dashboard', DashboardPageAction::class)->add(new AuthMiddleware());
        $group->get('', HomePageAction::class);
    });
    /*  $app->group('/page', function (Group $group) {
        $group->get('/', function (Request $request, Response $response) {
            $path_to_temp = $c->get('resources')['template'];
            $path_to_view = $c->get('resources')['views'];
            $renderer = new PhpRenderer();
            $renderer->setTemplatePath($path_to_temp);
            $renderer->setLayout('layout.php');
            $renderer->setTemplatePath($path_to_view);
            return $renderer->render($response, 'loading_view.php', $this->meta['home']);
        });
        $group->get('/trang-chu', HomePageAction::class);
        $group->get('/tin-tuc', NewsPageAction::class);
        $group->get('/bieu-hien-benh', SymptomsPageAction::class);
        $group->get('/cach-phong-tranh', PrecautionPageAction::class);
    }); */

    $app->group('/hotline', function (Group $group) {
        $group->get('/all', ListHotlineAction::class);
        $group->post('/add', AddHotlineAction::class);
        $group->post('/edit', EditHotlineAction::class);
        $group->post('/remove', RemoveHotlineAction::class);
    })->add(new AuthMiddleware());

    $app->group('/user', function (Group $group) {
        $group->post('/login', UserLoginAction::class);
        $group->post('/logout', UserLogoutAction::class);
    });

    $app->get('/api/statistics', StatisticsAction::class);

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
    
    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: make sure this route is defined last
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], 
        '/{routes:.+}', 
        function (Request $request, Response $response) {
            throw new HttpNotFoundException($request);
    });
};
