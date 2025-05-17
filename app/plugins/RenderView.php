<?php

use App\Facades\View;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class RenderViewPlugin extends Plugin_Abstract
{
    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        if (
            $response instanceof Http
            && !$request->isXmlHttpRequest()
        ) {
            View::useLayout($response);
        }
    }
}
