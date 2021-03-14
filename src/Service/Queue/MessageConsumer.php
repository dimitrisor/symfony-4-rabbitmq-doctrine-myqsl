<?php

namespace App\Service\Queue;

use App\Model\Dto\MessageMetaDto;
use App\Model\Entity\Result;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Psr\Log\LoggerInterface;
use App\Model\Repository\ResultRepository;

class MessageConsumer implements ConsumerInterface
{
    private ResultRepository $resultRepository;
    private LoggerInterface $logger;

    public function __construct(ResultRepository $resultRepository, LoggerInterface $logger)
    {
        $this->resultRepository = $resultRepository;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {
        $this->logger->info(sprintf("Result (%s) received in consumer successfully.", $msg->getRoutingKey()));
        echo sprintf("Result (%s) received in consumer successfully.", $msg->getRoutingKey());
        $objectNormalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer([$objectNormalizer], [new JsonEncoder()]);

        $metaData = $serializer->deserialize($msg->getBody(), MessageMetaDto::class, 'json');
        $routingKey = $msg->getRoutingKey();

        list($gatewayEui, $profileId, $endpointId, $clusterId, $attributeId) = explode('.', $routingKey);

        $result = new Result();
        $result->setGatewayEui($gatewayEui);
        $result->setProfileId($profileId);
        $result->setEndpointId($endpointId);
        $result->setClusterId($clusterId);
        $result->setAttributeId($attributeId);
        $result->setValue($metaData->getValue());
        $date = new \DateTime();
        $date->setTimestamp($metaData->getTimestamp());

        $this->resultRepository->save($result);

        echo sprintf("Result (%s) stored successfully in db.", $msg->getRoutingKey());
        $this->logger->info(sprintf("Result (%s) stored successfully in db.", $msg->getRoutingKey()));
    }
}