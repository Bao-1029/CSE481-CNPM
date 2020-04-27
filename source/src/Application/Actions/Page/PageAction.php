<?php
declare(strict_types=1);

namespace App\Application\Actions\Page;

use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Response as Response;
use Slim\Views\PhpRenderer;
use RuntimeException;

abstract class PageAction extends Action {
    /**
     * @var NewsRepository
     */
    protected $renderer;
    protected $meta;
    protected $response;

    /**
     * @param LoggerInterface $logger
     * @param NewsRepository $newsRepository
     */
    public function __construct(LoggerInterface $logger, ContainerInterface $c)
    {
        try {
            $this->response = new Response();
            $this->meta = $c->get('page_meta_data');
            $path_to_view = $c->get('resources')['views'];
            parent::__construct($logger);
            $this->renderer = new PhpRenderer();
            $this->renderer->setTemplatePath($path_to_view);
            $this->renderer->setLayout('layout.php');
        } catch (RuntimeException $e) {
            $this->logger->error('Template might not exist\nError: ' . $e->getMessage());
        }
    }

    // private function initLayout($path_to_temp) {
    //     try {
    //         $this->renderer->setTemplatePath($path_to_temp);
    //         $this->renderer->setLayout('layout.php');
    //     } catch (RuntimeException $e) {
    //         $this->logger->error('Template might not exist\nError: ' . $e->getMessage());
    //     }
    // }
}
