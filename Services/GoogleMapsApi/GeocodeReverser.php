<?php

namespace Services\GoogleMapsApi;

use Engine\Configuration\Config;
use Engine\DTO\DTOBuilder;
use Models\DTO\GoogleMaps\Geolocation;
use Models\DTO\GoogleMaps\GoogleMapsResponse;
use Models\DTO\GoogleMaps\Location;

class GeocodeReverser
{
    /** @var MapsApiAdapter $mapsApiAdapter */
    private $mapsApiAdapter;

    public function __construct(MapsApiAdapter $mapsApiAdapter)
    {
        $mapsApiAdapter->init();
        $this->mapsApiAdapter = $mapsApiAdapter;
    }

    /**
     * @param Geolocation $geolocation
     * @return Location
     */
    public function getReversedLocation(Geolocation $geolocation)
    {
        /** @var array $latLngParam */
        $latLngParam = $this->generateLatLngParam($geolocation);
        $latLngParam = $this->attachAuthorization($latLngParam);

        /** @var \stdClass $response */
        $response = $this->mapsApiAdapter->getFromParams($latLngParam);

        /** @var GoogleMapsResponse $googleMapsResponse */
        $googleMapsResponse = DTOBuilder::build(GoogleMapsResponse::class, $response);
        $this->validateResponse($googleMapsResponse);

        return $this->getLocationFrom($googleMapsResponse);
    }

    /**
     * @param GoogleMapsResponse $googleMapsResponse
     * @return Location
     */
    private function getLocationFrom(GoogleMapsResponse $googleMapsResponse)
    {
        /** @var array $resultsCollection */
        $resultsCollection = $googleMapsResponse->getResults();

        /** @var Location[] $locations */
        $locations = DTOBuilder::buildCollection(Location::class, $resultsCollection);

        /** @var Location $location */
        $location = array_shift($locations);

        return $location;
    }

    /**
     * @param array $params
     * @return array
     */
    private function attachAuthorization(array $params) : array
    {
        $params['key'] = Config::get('googleMapsApiKey');

        return $params;
    }

    /**
     * @param Geolocation $geolocation
     * @return array
     */
    private function generateLatLngParam(Geolocation $geolocation): array
    {
        /** @var string $latLng */
        $latLng = $this->convertGeolocationToString($geolocation);

        return [
            'latlng' => $latLng
        ];
    }

    /**
     * @param Geolocation $geolocation
     * @return string
     */
    public function convertGeolocationToString(Geolocation $geolocation): string
    {
        return sprintf(
            '%.6f,%.6f',
            $geolocation->getLat(),
            $geolocation->getLng()
        );
    }

    /**
     * @param GoogleMapsResponse $googleMapsResponse
     * @throws \Exception
     */
    private function validateResponse(GoogleMapsResponse $googleMapsResponse)
    {
        /** @var string $status */
        $status = $googleMapsResponse->getStatus();

        if($this->isErrorInResponse($status)) {
            /** @var string $message */
            $message = sprintf(
                'Błąd połączenia z Google Maps API - status "%s"',
                $status
            );

            throw new \Exception($message);
        }

        if($status != MapsResponseStatuses::OK) {
            throw new ZeroResultsException('Znalezienie adresu niemożliwe - prawdopodobnie ISS znajduje się teraz nad Oceanem');
        }
    }

    /**
     * @param string $status
     * @return bool
     */
    private function isErrorInResponse(string $status)
    {
        return (!in_array($status, [
            MapsResponseStatuses::OK,
            MapsResponseStatuses::ZERO_RESULTS,
            MapsResponseStatuses::OVER_QUERY_LIMIT
        ]));
    }
}