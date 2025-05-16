<?php

use App\Facades\Log;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class DebugYafStagePlugin extends Plugin_Abstract
{
    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug('routerStartup');
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("routerShutdown");
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("dispatchLoopStartup");
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("preDispatch");
    }

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("postDispatch");
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("dispatchLoopShutdown");
    }
}
