<?php

use App\Infrastructure\ControllerAbstract;
use App\Exceptions\Http\HttpException;
use App\Facades\Env;
use NunoMaduro\Collision\Handler as ConsoleHandler;
use Whoops\{
    Run,
    Handler\JsonResponseHandler as JsonHandler,
    Handler\PrettyPageHandler as HtmlHandler
};

class ErrorController extends ControllerAbstract
{
    public function errorAction(\Throwable $exception)
    {
        $handler = $this;
        if (Env::isNotProduction()) {
            $handler = $this->getExceptionHandler();
        }

        if ($this->getRequest()->isCli()) {
            echo $handler->handleException($exception);

            exit(1);
        }

        $html = $handler->handleException($exception);
        $this->getResponse()->setBody($html);

        return false;
    }

    private function handleException(\Throwable $exception): string
    {
        $status = $exception->getCode() ?: 500;

        if (!($exception instanceof HttpException)) {
            $status = 500;
            $exception = new HttpException($exception->getMessage(), $status, $exception);
        }

        $this->getResponse()->setHeader('Status', $status);
        $this->setViewpath(\App\Facades\View::getViewsDirectory()); // in case we catch error from module

        return $exception->render($this->getView(), $this->isJsonRequest());
    }

    private function getExceptionHandler(): Run
    {
        $viewableHandler = $this->isJsonRequest()
            ? JsonHandler::class
            : HtmlHandler::class;

        if ($this->getRequest()->isCli()) {
            $viewableHandler = ConsoleHandler::class;
        }

        $exceptionHandler = new Run();
        $exceptionHandler->allowQuit(false);
        $exceptionHandler->writeToOutput(false);

        return $exceptionHandler->pushHandler(new $viewableHandler());
    }

    private function isJsonRequest(): bool
    {
        return $this->getRequest()->isXmlHttpRequest()
          || 'application/json' === $_SERVER['CONTENT_TYPE'];
    }
}
