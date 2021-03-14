<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace App\Service\Result;

class ResultProviderHelper
{

    private string $resultProviderUrl;

    public function __construct(string $resultProviderUrl)
    {
        $this->resultProviderUrl = $resultProviderUrl;
    }

    public function getProviderUrl(): string{
        return $this->resultProviderUrl;
    }
}