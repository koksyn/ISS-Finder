<?php

namespace Services\IssApi;

use Engine\DTO\DTOBuilder;
use GuzzleHttp\Exception\RequestException;
use Models\DTO\Iss\Coordinates;
use Models\DTO\GoogleMaps\Geolocation;
use Services\GoogleMapsApi\GeocodeReverser;
use Services\GoogleMapsApi\ZeroResultsException;

class IssCoordinates
{
    /** @var IssApiAdapter $issApiAdapter */
    private $issApiAdapter;
    /** @var GeocodeReverser $geocodeReverser */
    private $geocodeReverser;

    /**
     * @param IssApiAdapter $issApiAdapter
     * @param GeocodeReverser $geocodeReverser
     */
    public function __construct(IssApiAdapter $issApiAdapter, GeocodeReverser $geocodeReverser)
    {
        $issApiAdapter->init('coordinates');
        $this->issApiAdapter = $issApiAdapter;
        $this->geocodeReverser = $geocodeReverser;
    }

    /**
     * @param Geolocation $geolocation
     * @return Coordinates
     * @throws ZeroResultsException
     */
    public function getOneByGeolocation(Geolocation $geolocation)
    {
        /** @var string $latLng */
        $latLng = $this->geocodeReverser->convertGeolocationToString($geolocation);

        try {
            /** @var \stdClass $object */
            $object = $this->issApiAdapter->get($latLng);
        } catch (RequestException $exception) {
            if($exception->getCode() === 404) {
                throw new ZeroResultsException('Nie znaleziono (dostępne tylko dane z lądu)');
            }

            throw $exception;
        }

        /** @var Coordinates $coordinates */
        $coordinates = DTOBuilder::build(Coordinates::class, $object);

        return $coordinates;
    }
}