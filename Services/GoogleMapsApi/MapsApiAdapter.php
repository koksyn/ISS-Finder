<?php

namespace Services\GoogleMapsApi;

use Engine\Configuration\Config;
use Services\AbstractApiAdapter;

class MapsApiAdapter extends AbstractApiAdapter
{
    /**
     * @param string $endpoint
     * @return string
     */
    protected function generateUrl(string $endpoint): string
    {
        return sprintf('%s', Config::get('googleMapsUrl'));
    }
}