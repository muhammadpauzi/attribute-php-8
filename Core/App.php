<?php

namespace Core;

use Core\Attributes\Handlers\HttpHandler;
use Core\Http\Requests\Request;
use Core\Routing\Route;
use Core\Routing\Router;

final class App
{
    /**
     * @var Route[]
     */
    private array $routes;

    public function run(Router $router)
    {
        $request = new Request();
        $controllers = $router->getControllerReflectionObjects();

        $routes = [];
        foreach ($controllers as $controller) {
            $httpHandler = new HttpHandler($controller);

            foreach ($httpHandler->getRoutes() as $route) {
                $this->routes[] = $route;
            }
        }

        foreach ($this->routes as $route) {
            $pattern = "#^" . $route->getPath() . "$#";
            if (
                preg_match($pattern, $request->getPathRequest(), $variables)
                &&
                $request->getRequestMethod() == $route->getRequestMethod()
            ) {

                $method = $route->getMethod();
                $controller = $route->getInstanceController();
                // $controller->$method();

                array_shift($variables);
                call_user_func_array([$controller, $method], $variables);

                return;
            }
        }

        http_response_code(404);
        echo 'CONTROLLER NOT FOUND';
    }
}
