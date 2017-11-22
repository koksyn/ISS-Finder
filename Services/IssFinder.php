<?php

namespace Services;

use Models\DTO\GoogleMaps\Geolocation;
use Models\DTO\GoogleMaps\Location;
use Models\DTO\Iss\Coordinates;
use Models\DTO\Iss\Satellite;
use Services\GoogleMapsApi\GeocodeReverser;
use Services\GoogleMapsApi\ZeroResultsException;
use Services\IssApi\IssCoordinates;
use Services\IssApi\IssSatellites;

class IssFinder
{
    /** @var IssSatellites $issSatellites */
    private $issSatellites;
    /** @var IssCoordinates $issCoordinates */
    private $issCoordinates;
    /** @var GeocodeReverser $geocodeReverser */
    private $geocodeReverser;
    /** @var Satellite $satellite */
    private $satellite;
    /** @var Geolocation $geolocation */
    private $geolocation;
    /** @var Coordinates $coordinates */
    private $coordinates;
    /** @var Location $location */
    private $location;

    /**
     * @param IssSatellites $issSatellites
     * @param IssCoordinates $issCoordinates
     * @param GeocodeReverser $geocodeReverser
     */
    public function __construct(IssSatellites $issSatellites, IssCoordinates $issCoordinates, GeocodeReverser $geocodeReverser)
    {
        $this->issSatellites = $issSatellites;
        $this->issCoordinates = $issCoordinates;
        $this->geocodeReverser = $geocodeReverser;
    }

    /**
     * Initialize finding
     */
    public function run()
    {
        $this->satellite = $this->issSatellites->getFirstAvailable();
        $this->geolocation = $this->generateGeolocationFrom($this->satellite);

        $this->runCoordinates();
        $this->runLocation();
    }

    private function runCoordinates()
    {
        try {
            $this->coordinates = $this->issCoordinates->getOneByGeolocation($this->geolocation);
        } catch (ZeroResultsException $exception) {
            $this->coordinates = new Coordinates();
            $this->coordinates->setTimezoneId($exception->getMessage());
        }
    }

    private function runLocation()
    {
        try {
            $this->location = $this->geocodeReverser->getReversedLocation($this->geolocation);
        } catch (ZeroResultsException $exception) {
            $this->location = new Location();
            $this->location->setFormattedAddress($exception->getMessage());
        }
    }

    /**
     * @param Satellite $satellite
     * @return Geolocation
     */
    private function generateGeolocationFrom(Satellite $satellite)
    {
        $geolocation = new Geolocation();
        $geolocation->setLat($satellite->getLatitude());
        $geolocation->setLng($satellite->getLongitude());

        return $geolocation;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->location->getFormattedAddress();
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return $this->coordinates->getTimezoneId();
    }

    /**
     * @return string
     */
    public function getGeolocationString()
    {
        return $this->geocodeReverser->convertGeolocationToString($this->geolocation);
    }
}