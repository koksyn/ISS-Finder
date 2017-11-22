<?php

namespace Models\DTO\GoogleMaps;

class Geometry
{
    /** @var Geolocation $location */
    private $location;

    /** @var string $locationType */
    private $locationType;

    /** @var Viewport $viewport */
    private $viewport;

    /**
     * @return Geolocation
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Geolocation $location
     */
    public function setLocation(Geolocation $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocationType(): string
    {
        return $this->locationType;
    }

    /**
     * @param string $locationType
     */
    public function setLocationType(string $locationType)
    {
        $this->locationType = $locationType;
    }

    /**
     * @return Viewport
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**
     * @param Viewport $viewport
     */
    public function setViewport(Viewport $viewport)
    {
        $this->viewport = $viewport;
    }
}