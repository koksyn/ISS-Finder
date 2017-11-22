<?php

namespace Engine\Routing\Validators;

use Engine\Http\Response;
use Engine\ValidatorInterface;

class ResponseValidator implements ValidatorInterface
{
    /**
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function validate($data): bool
    {
        if($this->isInvalidResponse($data)) {
            /** @var string $message */
            $message = $this->getInvalidResponseMessage();

            throw new \Exception($message);
        }

        return true;
    }

    /**
     * @param mixed $response
     * @return bool
     */
    private function isInvalidResponse($response)
    {
        return !($response instanceof Response);
    }

    /**
     * @return string
     */
    private function getInvalidResponseMessage()
    {
        $reflectionClass = new \ReflectionClass(Response::class);

        /** @var string $namespaceName */
        $namespaceName = $reflectionClass->getNamespaceName();

        return sprintf('Invalid controller response type, only instance of "%s" class is allowed.', $namespaceName);
    }
}