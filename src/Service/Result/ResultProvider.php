<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace App\Service\Result;

use App\Model\Dto\ResultDto;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ResultProvider
{
    private HttpClientInterface $client;
    protected SerializerInterface $serializer;
    private LoggerInterface $logger;
    private ResultProviderHelper $resultProviderHelper;

    public function __construct(ResultProviderHelper $resultProviderHelper, HttpClientInterface $httpClient, SerializerInterface $serializer, LoggerInterface $logger)
    {
        $this->resultProviderHelper = $resultProviderHelper;
        $this->client = $httpClient;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    public function fetch(): ResultDto
    {
        $endpoint = $this->resultProviderHelper->getProviderUrl();
        $type = 'GET';
        $result = null;
        try {
            $response = $this->client->request($type, $endpoint);
            $data = $response->getContent();
            $result = $this->serializer->deserialize($data, ResultDto::class, 'json');
        } catch (HttpExceptionInterface $e) {
            $this->logger->error(sprintf("Fail to fetch Result in %s from url %s.", __CLASS__, $endpoint));
            throw new ResultProviderException(Response::HTTP_INTERNAL_SERVER_ERROR, "Something went wrong on our side, please try again in a few minutes", $e);
        } catch (TransportExceptionInterface $e) {
            $this->logger->error(sprintf("Error at the transport level in result service %s.", $endpoint));
            throw new ResultProviderException(Response::HTTP_INTERNAL_SERVER_ERROR, "Something went wrong on our side, please try again in a few minutes", $e);
        }

        $this->logger->info(sprintf("Result (%s) fetched successfully to Queue from url %s.", $result->getRoutingKey(), $endpoint));

        return $result;
    }
}