<?php

namespace Controllers;

use Engine\Controller;
use Services\IssFinder;

class IssController extends Controller
{
    public function indexAction()
    {
        /** @var IssFinder $issFinder */
        $issFinder = $this->get('issFinder');
        $issFinder->run();

        /** @var string $now */
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        return $this->generateView('iss.html.php', [
            'address' => $issFinder->getAddress(),
            'timeZone' => $issFinder->getTimeZone(),
            'geolocationString' => $issFinder->getGeolocationString(),
            'now' => $now
        ]);
    }
}