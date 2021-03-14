<?php

namespace App\Model\Dto;

use App\Model\ResultTrait;

class ResultDto
{
    use ResultTrait;

    public $gatewayEui;
    public $profileId;
    public $endpointId;
    public $clusterId;
    public $attributeId;
    public $value;
    public $timestamp;

    /**
     * ResultDto constructor.
     * @param $gatewayEui
     * @param $profileId
     * @param $endpointId
     * @param $clusterId
     * @param $attributeId
     * @param $value
     * @param $timestamp
     */
    public function __construct($gatewayEui, $profileId, $endpointId, $clusterId, $attributeId, $value = null, $timestamp = null)
    {
        $this->gatewayEui = $gatewayEui;
        $this->profileId = $profileId;
        $this->endpointId = $endpointId;
        $this->clusterId = $clusterId;
        $this->attributeId = $attributeId;
        $this->value = $value;
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getGatewayEui()
    {
        return $this->gatewayEui;
    }

    /**
     * @param mixed $gatewayEui
     */
    public function setGatewayEui($gatewayEui): void
    {
        $this->gatewayEui = $gatewayEui;
    }

    /**
     * @return mixed
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * @param mixed $profileId
     */
    public function setProfileId($profileId): void
    {
        $this->profileId = $profileId;
    }

    /**
     * @return mixed
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * @param mixed $endpointId
     */
    public function setEndpointId($endpointId): void
    {
        $this->endpointId = $endpointId;
    }

    /**
     * @return mixed
     */
    public function getClusterId()
    {
        return $this->clusterId;
    }

    /**
     * @param mixed $clusterId
     */
    public function setClusterId($clusterId): void
    {
        $this->clusterId = $clusterId;
    }

    /**
     * @return mixed
     */
    public function getAttributeId()
    {
        return $this->attributeId;
    }

    /**
     * @param mixed $attributeId
     */
    public function setAttributeId($attributeId): void
    {
        $this->attributeId = $attributeId;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        $this->timestamp = $timestamp;
    }

}
