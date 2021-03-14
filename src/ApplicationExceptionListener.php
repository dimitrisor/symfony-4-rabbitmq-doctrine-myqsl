<?php

namespace App;

use Throwable;
use App\Service\Result\ResultProviderException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApplicationExceptionListener
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $response = null;
        $ex = $event->getThrowable();
        if($ex instanceof ResultProviderException){
            $response = $this->handleKnownException($ex);
        }else{
            $response = $this->handleUnknownException($ex);
        }
        $event->setResponse($response);
    }

    private function handleKnownException(ResultProviderException $ex): JsonResponse
    {
        $message = $ex->getMessage();
        $statusCode = $ex->getStatusCode();
        return new JsonResponse(array("message" => $message), $statusCode);
    }

    private function handleUnknownException(Throwable $ex): JsonResponse
    {
        $this->logger->error(sprintf("ApplicationException: %s", $ex->getMessage()));
        $message = "Something went wrong on our side, please try again in a few minutes";
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        return new JsonResponse(array("message" => $message), $statusCode);
    }
}