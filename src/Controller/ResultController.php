<?php

namespace App\Controller;

use App\Model\Dto\MessageMetaDto;
use App\Service\Queue\MessageProducerService;
use App\Service\Result\ResultProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\HttpClient\Chunk\ServerSentEvent;
use Symfony\Component\HttpClient\EventSourceHttpClient;

class ResultController
{
    private ResultProvider $resultsService;
    private MessageProducerService $messageService;

    public function __construct(ResultProvider $resultsService, MessageProducerService $messageService)
    {
        $this->resultsService = $resultsService;
        $this->messageService = $messageService;
    }

    /**
     * @Route("/results/process", methods={"POST"})
     */
    public function process(): JsonResponse
    {
        $result = $this->resultsService->fetch();
        $messageMetadata = new MessageMetaDto($result->getValue(), $result->getTimestamp());
        $this->messageService->publish($messageMetadata, $result->getRoutingKey());
        return new JsonResponse(array('message'=>'Result published successfully to Queue'));
    }
}