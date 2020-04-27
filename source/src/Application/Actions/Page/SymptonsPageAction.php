<?php

declare(strict_types=1);

namespace App\Application\Actions\Page;

use Psr\Http\Message\ResponseInterface as Response;
use RuntimeException;
use InvalidArgumentException;

class SymptomsPageAction extends PageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        try {
            return $this->renderer->render($this->response, 'symptoms.php', $this->meta['symptoms']);
        } catch (RuntimeException $e) {
            $this->logger->error('Template might not exist\nError: ' . $e->getMessage());
        } catch (InvalidArgumentException $e) {
            $this->logger->error('$data contains \`template\` property\nError: ' . $e->getMessage());
        }
    }
}
