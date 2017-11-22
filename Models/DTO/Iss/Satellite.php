<?php

namespace Models\DTO\Iss;

class Satellite
{
    /** @var int $id */
    private $id;
    
    /** @var string $name */
    private $name;
    
    /** @var float $latitude */
    private $latitude;
    
    /** @var float $longitude */
    private $longitude;
    
    /** @var float $altitude */
    private $altitude;
    
    /** @var float $velocity */
    private $velocity;
    
    /** @var string $visibility */
    private $visibility;
    
    /** @var float $footprint */
    private $footprint;
    
    /** @var int $timestamp */
    private $timestamp;
    
    /** @var float $daynum */
    private $daynum;
    
    /** @var float $solarLat */
    private $solarLat;
    
    /** @var float $solarLon */
    private $solarLon;
    
    /** @var string $units */
    private $units;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

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
     * @return float
     */
    public function getAltitude(): float
    {
        return $this->altitude;
    }

    /**
     * @param float $altitude
     */
    public function setAltitude(float $altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return float
     */
    public function getVelocity(): float
    {
        return $this->velocity;
    }

    /**
     * @param float $velocity
     */
    public function setVelocity(float $velocity)
    {
        $this->velocity = $velocity;
    }

    /**
     * @return string
     */
    public function getVisibility(): string
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility(string $visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return float
     */
    public function getFootprint(): float
    {
        return $this->footprint;
    }

    /**
     * @param float $footprint
     */
    public function setFootprint(float $footprint)
    {
        $this->footprint = $footprint;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return float
     */
    public function getDaynum(): float
    {
        return $this->daynum;
    }

    /**
     * @param float $daynum
     */
    public function setDaynum(float $daynum)
    {
        $this->daynum = $daynum;
    }

    /**
     * @return float
     */
    public function getSolarLat(): float
    {
        return $this->solarLat;
    }

    /**
     * @param float $solarLat
     */
    public function setSolarLat(float $solarLat)
    {
        $this->solarLat = $solarLat;
    }

    /**
     * @return float
     */
    public function getSolarLon(): float
    {
        return $this->solarLon;
    }

    /**
     * @param float $solarLon
     */
    public function setSolarLon(float $solarLon)
    {
        $this->solarLon = $solarLon;
    }

    /**
     * @return string
     */
    public function getUnits(): string
    {
        return $this->units;
    }

    /**
     * @param string $units
     */
    public function setUnits(string $units)
    {
        $this->units = $units;
    }
}