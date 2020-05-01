<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserPasswordException extends DomainRecordNotFoundException
{
    public $message = 'Mật khẩu không chính xác';
}
