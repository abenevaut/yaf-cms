<?php

namespace App\Services;

use Yaf\Response_Abstract;
use Yaf\View\Simple as ViewSimple;

final class ViewsService
{
    public function __construct(
        protected string $viewsDirectory,
        protected string $layout = 'layout',
    ) {}

    public function getViewsDirectory(): string
    {
        return $this->viewsDirectory;
    }

    public function useLayout(Response_Abstract $response): void
    {
        $body = $response->getBody();
        $response->clearBody();

        $layout = new ViewSimple($this->getViewsDirectory());
        $layout->assign('content', $body);

        $renderedHtml = $layout->render("{$this->layout}.phtml");

        $response->setBody($renderedHtml);
    }
}
