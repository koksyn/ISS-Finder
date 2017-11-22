<?php

namespace Resolvers;

use Engine\Dependency\DependencyInjection;
use Engine\ResolverInterface;
use Services\GoogleMapsApi\GeocodeReverser;
use Services\GoogleMapsApi\MapsApiAdapter;
use Services\IssApi\IssApiAdapter;
use Services\IssApi\IssCoordinates;
use Services\IssApi\IssSatellites;
use Services\IssFinder;

class UserDependencyResolver implements ResolverInterface
{
    /**
     * Resolves User dependencies using IoC container
     */
    public static function resolve()
    {
        DependencyInjection::register('mapsApi.adapter', function () {
            return new MapsApiAdapter();
        });

        DependencyInjection::register('mapsApi.geocodeReverser', function(DependencyInjection $di) {
            $mapsApiAdapter = $di::resolve('mapsApi.adapter');

            return new GeocodeReverser($mapsApiAdapter);
        });

        DependencyInjection::register('issApi.adapter', function () {
            return new IssApiAdapter();
        });

        DependencyInjection::register('issApi.issSatellites', function(DependencyInjection $di) {
            $issApiAdapter = $di::resolve('issApi.adapter');

            return new IssSatellites($issApiAdapter);
        });

        DependencyInjection::register('issApi.issCoordinates', function(DependencyInjection $di) {
            $issApiAdapter = $di::resolve('issApi.adapter');
            $geocodeReverser = $di::resolve('mapsApi.geocodeReverser');

            return new IssCoordinates($issApiAdapter, $geocodeReverser);
        });

        DependencyInjection::register('issFinder', function(DependencyInjection $di) {
            $issSatellites = $di::resolve('issApi.issSatellites');
            $issCoordinates = $di::resolve('issApi.issCoordinates');
            $geocodeReverser = $di::resolve('mapsApi.geocodeReverser');

            return new IssFinder($issSatellites, $issCoordinates, $geocodeReverser);
        });
    }
}