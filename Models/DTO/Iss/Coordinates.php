<?php

namespace Models\DTO\Iss;

class Coordinates
{
    /** @var float $latitude */
    private $latitude;
    /** @var float $longitude */
    private $longitude;
    /** @var string $timezoneId */
    private $timezoneId;
    /** @var integer $offset */
    private $offset;
    /** @var string $countryCode */
    private $countryCode;
    /** @var string $mapUrl */
    private $mapUrl;

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getTimezoneId(): string
    {
        return $this->timezoneId;
    }

    /**
     * @param string $timezoneId
     */
    public function setTimezoneId(string $timezoneId)
    {
        $this->timezoneId = $timezoneId;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getMapUrl(): string
    {
        return $this->mapUrl;
    }

    /**
     * @param string $mapUrl
     */
    public function setMapUrl(string $mapUrl)
    {
        $this->mapUrl = $mapUrl;
    }
}