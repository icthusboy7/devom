<?php

declare(strict_types=1);

namespace Appto\Common\Infrastructure\Symfony\Messenger;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

class FailureCatcherMiddleware implements MiddlewareInterface
{
    /**
     * @param Envelope $envelope
     * @param StackInterface $stack
     *
     * @return Envelope
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            $returnedEnvelope = $stack->next()->handle($envelope, $stack);
        } catch (HandlerFailedException $e) {
            throw $e->getNestedExceptions()[0];
        }

        return $returnedEnvelope;
    }
}
