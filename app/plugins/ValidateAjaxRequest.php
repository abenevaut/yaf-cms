<?php

use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class ValidateAjaxRequestPlugin extends Plugin_Abstract
{
	public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        if (
            $response instanceof Http
            && $request->isXmlHttpRequest()
            && 'application/x-www-form-urlencoded' === $request->getHeader('Content-Type')
        ) {
            throw new \App\Exceptions\Http\BadRequestHttpException();
        }
	}
}
