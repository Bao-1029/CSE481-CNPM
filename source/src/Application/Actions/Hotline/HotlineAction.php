<?php
declare(strict_types=1);

namespace App\Application\Actions\Hotline;

use App\Application\Actions\Action;
use App\Domain\Hotline\HotlineRepository;
use Error;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpUnauthorizedException;
use SlimSession\Helper;

abstract class HotlineAction extends Action {
    /**
     * @var HotlineRepository
     */
    protected $hotlineRepository;
    protected $session;

    /**
     * @param LoggerInterface $logger
     * @param HotlineRepository $hotlineRepository
     */
    public function __construct(LoggerInterface $logger, HotlineRepository $hotlineRepository)
    {
        parent::__construct($logger);
        $this->session = new Helper;
        if (!$this->session->exists('userId'))
            throw new HttpUnauthorizedException($this->request, 'Bạn phải đăng nhập để tiếp tục');
        $this->newsRepository = $hotlineRepository;
    }
}
