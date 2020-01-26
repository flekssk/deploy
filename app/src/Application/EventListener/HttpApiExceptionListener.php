<?php

namespace App\Application\EventListener;

use App\Application\Exception\ValidationException;
use App\Application\ResponseFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ExceptionListener
 * @package App\Application\EventListener
 */
class HttpApiExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     * @throws \Exception
     */
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();
        if ($event->getRequest() instanceof Request) {
            if ($exception instanceof ValidationException) {
                $response = ResponseFactory::createErrorResponse(
                    $event->getRequest(),
                    $exception->getMessage(),
                    $exception->getErrors()
                );
            } elseif ($exception instanceof HttpException) {
                $response = ResponseFactory::createErrorResponse(
                    $event->getRequest(),
                    $exception->getMessage(),
                    [],
                    $exception->getStatusCode()
                );
            } else {
                throw $exception;
            }
        } else {
            throw $exception;
        }

        $event->setResponse($response);
    }
}
