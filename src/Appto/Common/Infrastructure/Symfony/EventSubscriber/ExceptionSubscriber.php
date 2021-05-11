<?php

declare(strict_types=1);

namespace Appto\Common\Infrastructure\Symfony\EventSubscriber;

use Appto\Common\Infrastructure\Symfony\Exception\ExceptionsHttpStatusCodeMapping;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    private $exceptionHandler;
    private $environment;

    public function __construct(ExceptionsHttpStatusCodeMapping $exceptionHandler, string $env)
    {
        $this->exceptionHandler = $exceptionHandler;
        $this->environment = $env;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => ['onKernelException', 0]];
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception      = $event->getException();
        $event->setResponse($this->createResponseFromErrorException($exception));
    }

    private function createResponseFromErrorException(Exception $exception): Response
    {
        $statusCode = $this->exceptionHandler->statusCode($exception);
        $data['error'] = [
            'type'    => (new \ReflectionClass($exception))->getShortName(),
            'message' => $exception->getMessage(),
            'status' => $statusCode,
        ];

        if ('dev' === $this->environment) {
            $data['error']['meta'] = [
              'file' =>  $exception->getFile(),
              'line' =>  $exception->getLine(),
              'trace' =>  $exception->getTraceAsString(),
//              'original_class' =>  $exception->getOriginalClassName(),
              'code' =>  $exception->getCode(),
            ];
        }
        return new JsonResponse($data, $statusCode);
    }
}
