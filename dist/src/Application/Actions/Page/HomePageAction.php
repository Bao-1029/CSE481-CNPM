<?php
declare(strict_types=1);

namespace App\Application\Actions\Page;

use Psr\Http\Message\ResponseInterface as Response;
use RuntimeException;
use InvalidArgumentException;

class HomePageAction extends PageAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        try {
            $this->response = $this->response->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST')
                    ->withHeader("Access-Control-Expose-Headers", "Access-Control-*");
            return $this->renderer->render($this->response, 'loading_view.php', $this->meta['home']);
        } catch (RuntimeException $e) {
            $this->logger->error('Template might not exist\nError: ' . $e->getMessage());
        } catch (InvalidArgumentException $e) {
            $this->logger->error('$data contains \`template\` property\nError: ' . $e->getMessage());
        }
    }
}
