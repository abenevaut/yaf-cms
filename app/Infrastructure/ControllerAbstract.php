<?php

namespace App\Infrastructure;

use Yaf\Application;
use Yaf\Controller_Abstract;

abstract class ControllerAbstract extends Controller_Abstract
{
    const WITHOUT_VIEW = false;

    public function asJson(array $data = [], int $status = 200): bool
    {
        $jsonData = json_encode($data, JSON_THROW_ON_ERROR);

        $this->getResponse()->setHeader('Status', $status);
        $this->getResponse()->clearbody();
        $this->getResponse()->setBody($jsonData);

        return ControllerAbstract::WITHOUT_VIEW;
    }

    public function redirect(string $url = '/'): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            parent::redirect($url);

            return ControllerAbstract::WITHOUT_VIEW;
        }

        $basUri = Application::app()->getConfig()->get('application.baseUri');
        $uri = '/' . rtrim(ltrim($basUri, '/'), '/') . '/' . ltrim($url, '/');
        $uri = '/' . ltrim($uri, '/');

        parent::redirect($uri);

        return ControllerAbstract::WITHOUT_VIEW;
    }
}
