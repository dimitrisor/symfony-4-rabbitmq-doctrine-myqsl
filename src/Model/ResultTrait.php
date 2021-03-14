<?php

namespace App\Model;

Trait ResultTrait
{
    public function getRoutingKey() : string {
        $gatewayEui = hexdec($this->getGatewayEui());
        $profileId = hexdec($this->getProfileId());
        $endpointId = hexdec($this->getEndpointId());
        $clusterId = hexdec($this->getClusterId());
        $attributeId = hexdec($this->getAttributeId());
        return sprintf("%.0f.%.0f.%.0f.%.0f.%.0f",$gatewayEui,$profileId,$endpointId,$clusterId,$attributeId);
    }
}
