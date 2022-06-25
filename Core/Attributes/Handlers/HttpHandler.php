<?php

namespace Core\Attributes\Handlers;

use Core\Http\BaseController;
use ReflectionObject;

class HttpHandler
{
    public function __construct()
    {
        echo "HELLO WORLD";
    }
    public function executeRoute(BaseController $controller)
    {
        $reflection = new ReflectionObject($controller);

        foreach ($reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(Route::class);

            if (count($attributes) > 0) {
                $methodName = $method->getName();
                // send parameter as request data
                $controller->$methodName();
            }
        }

        // $actionHandler->execute();
    }
}
