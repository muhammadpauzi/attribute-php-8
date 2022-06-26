<?php

namespace Apps\Controllers;

use Core\Attributes\Controller;
use Core\Attributes\Route;
use Core\Http\Controllers\BaseController;

#[Controller(base_url: '/home')]
class HomeController extends BaseController
{
    #[Route(method: "GET", url: '/index')]
    public function index()
    {
        echo "Home Endpoint";
    }

    private function _helperFunction()
    {
    }
}
