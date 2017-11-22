<?php

namespace Engine\Observer;

use Engine\Http\Response;
use Engine\Listeners\ListenerView;

class Subject
{
    /** @var ObserverInterface[] $observers */
    protected $observers;

    public function __construct()
    {
        $this->observers = [];
    }

    /**
     * @param ObserverInterface $observer
     */
    public function attachObserver(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param mixed $extraData
     */
    public function notifyObservers($extraData = null)
    {
        foreach($this->observers as $observer) {
            $observer->update($extraData);
        }
    }

    /**
     * @return array
     */
    public function handleObservers()
    {
        /** @var array $messages */
        $messages = [];

        foreach($this->observers as $observer) {
            $messages[get_class($observer)] = $observer->handle();
        }

        return $messages;
    }

    /**
     * @param array $messages
     * @param string $fileName
     * @return Response
     */
    public function renderMessages(array $messages, string $fileName)
    {
        $view = new ListenerView($fileName);
        $view->setParams([
            'messages' => $messages
        ]);

        return $view->getFilledResponse();
    }
}