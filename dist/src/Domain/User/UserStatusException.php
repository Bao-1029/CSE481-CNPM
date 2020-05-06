<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserStatusException extends DomainRecordNotFoundException
{
    public $message = 'Bạn chưa được cấp quền truy cập trang web';
}
