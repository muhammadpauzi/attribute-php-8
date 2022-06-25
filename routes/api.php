<?php

use Apps\Controllers\HomeController;
use Core\Attributes\Handlers\HttpHandler;

$httpHandler = new HttpHandler();

// add controllers here
$httpHandler->executeRoute(new HomeController());
