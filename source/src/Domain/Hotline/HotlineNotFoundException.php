<?php
declare(strict_types=1);

namespace App\Domain\Hotline;

use App\Domain\DomainException\DomainRecordNotFoundException;

class HotlineNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'Không tìm thấy số điện thoại';
}
