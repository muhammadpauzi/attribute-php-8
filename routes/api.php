<?php

use Apps\Controllers\HomeController;
use Apps\Controllers\PostController;
use Core\Attributes\Handlers\HttpHandler;
use Core\Routing\Router;

$apiRouter = new Router();

$apiRouter->registerControllers([
    new HomeController,
    new PostController
]);
