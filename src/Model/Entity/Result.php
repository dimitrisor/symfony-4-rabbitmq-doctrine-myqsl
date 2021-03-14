<?php


namespace App\Model\Entity;

use DateTime;
use App\Model\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Model\ResultTrait;

/**
 * @ORM\Entity(repositoryClass=ResultRepository::class)
 * @ORM\Table(name = "results")
 */
class Result
{
    use ResultTrait;

    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $gatewayEui;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $profileId;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $endpointId;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $clusterId;

    /**
     * @ORM\Column(type = "string", length = 20)
     */
    private $attributeId;

    /**
     * @ORM\Column(type = "integer")
     */
    private $value;

    /**
     * @ORM\Column(type = "datetime")
     * @ORM\Version
     * @var DateTime
     */
    private DateTime $timestamp;

    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
     * @return DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param DateTime $timestamp
     */
    public function setTimestamp(DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}