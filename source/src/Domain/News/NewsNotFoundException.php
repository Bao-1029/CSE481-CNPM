<?php
declare(strict_types=1);

namespace App\Domain\News;

use App\Domain\DomainException\DomainRecordNotFoundException;

class NewsNotFoundException extends DomainRecordNotFoundException {
    public $message = '';
}

?>