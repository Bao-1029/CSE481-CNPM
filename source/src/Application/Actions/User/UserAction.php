<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;
use SlimSession\Helper;

abstract class UserAction extends Action
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected $session;

    /**
     * @param LoggerInterface $logger
     * @param UserRepository  $userRepository
     */
    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->session = new Helper;
        $this->userRepository = $userRepository;
    }
}
