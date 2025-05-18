<?php

namespace App\Services;

use Yaf\Response_Abstract;
use Yaf\View\Simple as ViewSimple;

final class ViewsService
{
    public function __construct(
        protected string $viewsDirectory,
        protected string $layout = 'layout',
        protected array $layoutData = [],
    ) {}

    public function getViewsDirectory(): string
    {
        return $this->viewsDirectory;
    }

    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->layoutData['title'] = $title;

        return $this;
    }

    public function useLayout(Response_Abstract $response): void
    {
        $this->layoutData['content'] = $response->getBody();
        $response->clearBody();

        $layout = new ViewSimple($this->getViewsDirectory());
        $layout->assign('layoutData', $this->layoutData);

        $renderedHtml = $layout->render("{$this->layout}.phtml");

        $response->setBody($renderedHtml);
    }
}
