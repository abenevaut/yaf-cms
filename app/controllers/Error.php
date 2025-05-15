<?php

use App\Infrastructure\ControllerAbstract;
use App\Exceptions\Http\HttpException;
use App\Services\Environment;
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
        if (Environment::isNotProduction()) {
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
        return $this->getRequest()->isXmlHttpRequest();
    //      || 'application/json' === $this->getRequest()->getHeaders()['Content-Type']
    //!\ here the request was reset to redirect to error controller
    }
}
