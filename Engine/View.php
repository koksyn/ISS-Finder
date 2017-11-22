<?php

namespace Engine;

use Engine\Http\Response;

class View
{
    /** @var string $filePath */
    private $filePath;
    /** @var array $params */
    private $params;

    /**
     * View constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->filePath = self::getViewFilePath($fileName);
        $this->params = [];
    }

    /**
     * @param string $fileName
     * @return string
     */
    protected static function getViewFilePath(string $fileName)
    {
        return __DIR__ . '/../Views/' . $fileName;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return Response
     */
    public function getFilledResponse()
    {
        /** @var string $content */
        $content = $this->getRenderedConent();

        return new Response($content);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getRenderedConent()
    {
        if(!file_exists($this->filePath)) {
            throw new \Exception(sprintf('Unable to load View from file "%s". File does not exists.', $this->filePath));
        }

        ob_start();
        extract($this->params);
        require_once $this->filePath;

        return ob_get_clean();
    }

    /**
     * @param string $filePath
     */
    protected function setFilePath(string $filePath)
    {
        $this->filePath = $filePath;
    }
}