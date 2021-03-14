<?php


namespace App\Model\Dto;


class MessageMetaDto {
    public $value;
    public $timestamp;

    /**
     * @param $value
     * @param $timestamp
     */
    public function __construct($value, $timestamp)
    {
        $this->value = $value;
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}