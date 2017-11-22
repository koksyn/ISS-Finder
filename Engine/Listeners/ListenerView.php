<?php

namespace Engine\Listeners;

use Engine\View;

class ListenerView extends View
{
    /**
     * View constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        parent::__construct($fileName);
        $this->setFilePath(self::getViewFilePath($fileName));
    }

    /**
     * @param string $fileName
     * @return string
     */
    protected static function getViewFilePath(string $fileName)
    {
        return __DIR__ . '/../Views/' . $fileName;
    }
}