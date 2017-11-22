<?php

require 'vendor/autoload.php';

use Engine\Initializer;

$initializer = new Initializer();

print $initializer->handleRequest();
