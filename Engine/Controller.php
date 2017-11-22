<?php

namespace Engine;

use Engine\Dependency\DependencyInjection;
use Engine\Http\Request;
use Engine\Http\Response;

abstract class Controller
{
    /** @var Request $request */
    private $request;

    /**
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    protected function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Loads instance from IoC Container
     *
     * @param string $name
     * @return mixed
     */
    protected function get(string $name)
    {
        return DependencyInjection::resolve($name);
    }

    /**
     * @param string $fileName
     * @param array $params
     * @return Response
     */
    protected function generateView(string $fileName, array $params = [])
    {
        $view = new View($fileName);

        $params = $this->attachBaseUrlParam($params);
        $view->setParams($params);

        return $view->getFilledResponse();
    }

    /**
     * @param array $params
     * @return array
     */
    private function attachBaseUrlParam(array $params)
    {
        $params['baseUrl'] = $this->request->getBaseUrl();

        return $params;
    }
}