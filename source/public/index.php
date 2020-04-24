<?php
declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

// $APP_ROOT = __DIR__ . '../';

require __DIR__ . '/../vendor/autoload.php';


// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/../app/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Register middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

/** @var bool $displayErrorDetails */
$displayErrorDetails = $container->get('settings')['displayErrorDetails'];

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

$app->add(\App\Application\Middleware\CorsMiddleware::class);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);

/*
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$crawler;
$result = [];

$client = new Client();

 $crawler = $client->request('GET', 'https://news.google.com/topics/CAAqKAgKIiJDQkFTRXdvTkwyY3ZNVEZtY2pFMWRERTFhQklDZG1rb0FBUAE?hl=vi&gl=VN&ceid=VN%3Avi');
$baseHref = $crawler->getBaseHref();

$crawler->filter('.xrnccd .Cc0Z5d')->each(function (Crawler $node) {
	global $result;
	global $baseHref;
	$children = $node->children();
	$title = $children->children('.DY5T1d')->text();
	$link = $baseHref . substr($children->children('.DY5T1d')->attr('href'), 2);
	$source = $children->children('[jsname="Hn1wIf"] .wEwyrc')->text();
	$item = array(
		'title' => $title,
		'link'  => $link,
		'source' => $source
	);
	array_push($result, $item);
});

// var_dump($crawler);
var_dump($result); 


$crawler = $client->request('GET', 'https://ncov.moh.gov.vn/dong-thoi-gian', [], [], ['verify' => 'false']);
$this->crawler->filter('.timeline-sec .timeline-content')->each(function (Crawler $node) {
	array_push($this->result, $node->text());
});
var_dump($result);
*/
?>