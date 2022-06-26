<?php

namespace Apps\Controllers;

use Core\Attributes\Controller;
use Core\Attributes\Route;
use Core\Http\Controllers\BaseController;

#[Controller(base_url: '/posts')]
class PostController extends BaseController
{
    #[Route(method: "get", url: '/')]
    public function index()
    {
        echo "Post Endpoint";
    }

    #[Route(method: "post", url: '/create')]
    public function create()
    {
    }
}
