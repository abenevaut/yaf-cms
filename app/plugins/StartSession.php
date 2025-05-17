<?php

use App\Facades\Log;
use App\Facades\Session;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class StartSessionPlugin extends Plugin_Abstract
{
    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        if (
            $response instanceof Http
            && $request->getModuleName() !== 'Artisan'
        ) {
            Session::start();
            Log::pushProcessor(function ($record) use ($request) {
                $record->extra['sessionId'] = Session::sessionId();
                $record->extra['userId'] = Session::userId();

                return $record;
            });
            Log::info('StartSessionPlugin: Session started');
        }
    }
}
