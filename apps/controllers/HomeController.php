<?php

namespace Apps\Controllers;

use Core\Attributes\Controller;
use Core\Attributes\Route;
use Core\Http\BaseController;

#[Controller]
class HomeController extends BaseController
{
    #[Route('/home')]
    public function index()
    {
        echo "Home Endpoint";
    }

    private function _helperFunction()
    {
    }
}
