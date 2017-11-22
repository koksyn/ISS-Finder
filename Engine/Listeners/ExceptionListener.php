<?php

namespace Listeners;

use Engine\Listener;
use Engine\Listeners\ListenerView;
use Engine\Observer\ObserverInterface;
use PHPUnit\Runner\Exception;

class ExceptionListener extends Listener implements ObserverInterface
{
    /** @var \Exception $exception */
    private $exception;

    /**
     * @param mixed $extraData
     */
    public function update($extraData = null)
    {
        if($extraData instanceof \Exception) {
            $this->exception = $extraData;
        } else {
            $this->exception = new \Exception('Invalid type of Exception received in ExceptionListener');
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function handle()
    {
        if(empty($this->exception)) {
            return '';
        }

        /** @var array $params */
        $params = [
            'type' => get_class($this->exception),
            'file' => $this->exception->getFile(),
            'line' => $this->exception->getLine(),
            'message' => $this->exception->getMessage(),
            'trace' => str_replace(' ', '<br>', $this->exception->getTraceAsString())
        ];

        $view = new ListenerView('exceptionBody.html.php');
        $view->setParams($params);

        return $view->getRenderedConent();
    }
}