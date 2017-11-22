<?php

namespace Engine\Dependency\Resolvers;

use Engine\Configuration\ConfigLoader;
use Engine\Dependency\DependencyInjection;
use Engine\Engine;
use Engine\ResolverInterface;
use Engine\Routing\RouteBuilder;
use Engine\Routing\Router;
use Engine\Routing\Validators\ResponseValidator;
use Engine\Routing\Validators\RouteValidator;
use Listeners\ExceptionListener;

class EngineDependencyResolver implements ResolverInterface
{
    /**
     * Resolves Engine dependencies using IoC container
     */
    public static function resolve()
    {
        DependencyInjection::register('engine.config.loader', function() {
            return new ConfigLoader();
        });

        DependencyInjection::register('engine.listeners.exception', function() {
            return new ExceptionListener();
        });

        DependencyInjection::register('engine.routing.validator.response', function() {
            return new ResponseValidator();
        });

        DependencyInjection::register('engine.routing.validator.route', function() {
            return new RouteValidator();
        });

        DependencyInjection::register('engine.routing.route.builder', function(DependencyInjection $di) {
            /** @var RouteValidator $routeBuilder */
            $routeValidator = $di::resolve('engine.routing.validator.route');

            return new RouteBuilder($routeValidator);
        });

        DependencyInjection::register('engine.routing.router', function(DependencyInjection $di) {
            /** @var RouteBuilder $routeBuilder */
            $routeBuilder = $di::resolve('engine.routing.route.builder');
            /** @var ResponseValidator $responseValidator */
            $responseValidator = $di::resolve('engine.routing.validator.response');

            return new Router($routeBuilder, $responseValidator);
        });

        DependencyInjection::register('engine', function(DependencyInjection $di) {
            /** @var Router $router */
            $router = $di::resolve('engine.routing.router');

            return new Engine($router);
        });
    }
}