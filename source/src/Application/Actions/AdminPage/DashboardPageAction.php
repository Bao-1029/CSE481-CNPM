<?php
declare(strict_types=1);

namespace App\Application\Actions\AdminPage;

use Psr\Http\Message\ResponseInterface as Response;
use RuntimeException;
use InvalidArgumentException;

class DashboardPageAction extends PageAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        try {
            return $this->renderer->render($this->response, 'dashboard.php', $this->meta['dashboard']);
        } catch (RuntimeException $e) {
            $this->logger->error('Template might not exist\nError: ' . $e->getMessage());
        } catch (InvalidArgumentException $e) {
            $this->logger->error('$data contains \`template\` property\nError: ' . $e->getMessage());
        }
    }
}
