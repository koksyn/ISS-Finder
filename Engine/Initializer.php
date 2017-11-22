<?php

namespace Engine;

use Engine\Configuration\ConfigLoader;
use Engine\Dependency\DependencyInjection;
use Engine\Dependency\Resolvers\EngineDependencyResolver;
use Engine\Http\Request;
use Engine\Http\Response;
use Listeners\ExceptionListener;
use Resolvers\UserDependencyResolver;

class Initializer
{
    /** @var Engine $engine */
    private $engine;

    public function __construct()
    {
        $this->resolveDependencies();
        $this->initializeEnvironment();
    }

    private function resolveDependencies()
    {
        EngineDependencyResolver::resolve();
        UserDependencyResolver::resolve();
    }

    private function initializeEnvironment()
    {
        /** @var ConfigLoader $configLoader */
        $configLoader = DependencyInjection::resolve('engine.config.loader');
        $configLoader->loadConfiguration();

        /** @var ExceptionListener $exceptionListener */
        $exceptionListener = DependencyInjection::resolve('engine.listeners.exception');

        $this->engine = DependencyInjection::resolve('engine');
        $this->engine->attachObserver($exceptionListener);
    }

    /**
     * @return mixed
     */
    public function handleRequest()
    {
        /** @var Request $request */
        $request = Engine::getRequest();
        /** @var Response $response */
        $response = $this->engine->processRequest($request);

        return $response->getContent();
    }
}