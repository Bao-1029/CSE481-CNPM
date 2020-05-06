<?php
declare(strict_types=1);

namespace App\Application\Actions\Statistics;

use App\Application\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class StatisticsAction extends Action {
    protected $config;
    /**
     * @param LoggerInterface $logger
     * @param ContainerInterface $c
     */
    public function __construct(LoggerInterface $logger, ContainerInterface $c)
    {
        parent::__construct($logger);
        $this->config = $c->get('storage')['statistics'];
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $data = file_get_contents($this->config . '/data.json');
        
        return $this->respondWithData($data);
    }
}
