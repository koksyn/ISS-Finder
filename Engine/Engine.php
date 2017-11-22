<?php

namespace Engine;

use Engine\Http\Request;
use Engine\Http\RequestBuilder;
use Engine\Http\Response;
use Engine\Routing\Router;
use Engine\Observer\Subject;

class Engine extends Subject
{
    /** @var Router $router */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        parent::__construct();
        $this->router = $router;
    }

    /**
     * @return Request
     */
    public static function getRequest()
    {
        return RequestBuilder::build();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function processRequest(Request $request)
    {
        try {
            /** @var Response $response */
            $response = $this->router->resolve($request);

            return $response;
        }
        catch(\Exception $exception) {
            $this->notifyObservers($exception);

            /** @var array $messages */
            $messages = $this->handleObservers();

            return $this->renderMessages(
                $messages,
                'exception.html.php'
            );
        }
    }
}