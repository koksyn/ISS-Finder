<?php

namespace Models\DTO\GoogleMaps;

class Viewport
{
    /** @var Geolocation $northeast */
    private $northeast;

    /** @var Geolocation $southwest */
    private $southwest;

    /**
     * @return Geolocation
     */
    public function getNortheast(): Geolocation
    {
        return $this->northeast;
    }

    /**
     * @param Geolocation $northeast
     */
    public function setNortheast(Geolocation $northeast)
    {
        $this->northeast = $northeast;
    }

    /**
     * @return Geolocation
     */
    public function getSouthwest(): Geolocation
    {
        return $this->southwest;
    }

    /**
     * @param Geolocation $southwest
     */
    public function setSouthwest(Geolocation $southwest)
    {
        $this->southwest = $southwest;
    }
}