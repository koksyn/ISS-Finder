<?php

namespace Controllers;

use Engine\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->generateView('contact.html.php');
    }
}