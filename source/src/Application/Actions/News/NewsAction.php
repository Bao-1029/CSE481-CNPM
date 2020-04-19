<?php
declare(strict_types=1);

namespace App\Application\Actions\News;

use App\Application\Actions\Action;
use App\Domain\News\NewsRepository;
use Psr\Log\LoggerInterface;

abstract class NewsAction extends Action {
    /**
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * @param LoggerInterface $logger
     * @param NewsRepository $newsRepository
     */
    public function __construct(LoggerInterface $logger, NewsRepository $newsRepository)
    {
        parent::__construct($logger);
        $this->newsRepository = $newsRepository;
    }
}
?>