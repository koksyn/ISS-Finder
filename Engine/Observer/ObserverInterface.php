<?php

namespace Engine\Observer;

interface ObserverInterface
{
    /**
     * @param mixed $extraData
     */
    public function update($extraData = null);
}