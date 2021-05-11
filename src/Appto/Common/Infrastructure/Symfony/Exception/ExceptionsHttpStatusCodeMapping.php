<?php

declare(strict_types=1);

namespace Appto\Common\Infrastructure\Symfony\Exception;

use Appto\Common\Domain\Exception\InvalidArgumentException;
use Appto\Common\Domain\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ExceptionsHttpStatusCodeMapping
{
    private $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
        NotFoundException::class => Response::HTTP_NOT_FOUND,
        \DomainException::class => Response::HTTP_CONFLICT,
    ];

    public function register($exceptionClass, $statusCode): void
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function statusCode(\Exception $exception): int
    {
        foreach ($this->exceptions as $exceptionClass => $code) {
            if ($exception instanceof $exceptionClass) {
                return $code;
            }
        }

        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
