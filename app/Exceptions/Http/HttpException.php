<?php

namespace App\Exceptions\Http;

use App\Facades\Log;
use Yaf\View_Interface;

class HttpException extends \Exception
{
    protected $logLevel = 'emergency';

    public function render(View_Interface $view, bool $asJson = false): string
    {
        $error = $this->getMessage();
        $viewTemplate = $this->getCode() ?: 500;

        Log::log($this->logLevel, $error, [
            'exception' => $this,
        ]);

        return $asJson
            ? json_encode(compact('error'), JSON_THROW_ON_ERROR)
            : $view->render("error/{$viewTemplate}.phtml", compact('error'));
    }
}
