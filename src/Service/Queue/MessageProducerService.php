<?php

namespace App\Service\Queue;

use App\Model\Dto\MessageMetaDto;
use Psr\Log\LoggerInterface;

class MessageProducerService
{
    private MessageProducer $messageProducer;
    private LoggerInterface $logger;

    public function __construct(MessageProducer $messageProducer, LoggerInterface $logger)
    {
        $this->messageProducer = $messageProducer;
        $this->logger = $logger;
    }

    public function publish(MessageMetaDto $messageMetaData, string $routingKey)
    {
            $this->messageProducer->publish(json_encode($messageMetaData), $routingKey);
            $this->logger->info(sprintf("Result (%s) published successfully to Queue.", $routingKey));
    }
}