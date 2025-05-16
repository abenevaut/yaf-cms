<?php

use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class DisallowFrameEmbeddingPlugin extends Plugin_Abstract
{
	public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        if ($response instanceof Http) {
            $response->setHeader('X-Frame-Options', 'DENY');
            \App\Facades\Log::debug('DisallowFrameEmbeddingPlugin: X-Frame-Options header set to DENY');
        }
	}
}
