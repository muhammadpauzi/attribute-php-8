<?php

namespace Core\Attributes\Handlers;

use Core\Attributes\Controller;
use Core\Attributes\Route;
use Core\Routing\Route as RoutingRoute;
use ReflectionMethod;
use ReflectionObject;

class HttpHandler
{
    private array $route = [];

    public function __construct(private ReflectionObject $controllerObjectReflection)
    {
        $this->route = [
            "controller_class" => $this->controllerObjectReflection->getName(),
            "controller_args" => $this->getControllerArguments($this->controllerObjectReflection),
            "route_args" => $this->getRouteArguments($this->controllerObjectReflection),
        ];
    }

    private function getControllerArguments(ReflectionObject $reflection)
    {
        $attributeArguments = [];
        foreach ($reflection->getAttributes(Controller::class) as $attribute) {
            $controllerArguments = $attribute->getArguments();
            $attributeArguments = array_merge($controllerArguments);
        }
        return $attributeArguments;
    }

    /**
     * Untuk mengambil semua method yang menggunakan attribute Route dari sebuah Controller class/attribute
     */
    private function getRouteArguments(ReflectionObject $reflection)
    {
        $attributeArguments = [];
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes(Route::class) as $routeAttribute) {
                $routeArguments["arguments"] = $routeAttribute->getArguments();
                $routeArguments['route_method'] = $method;
                $attributeArguments[] = array_merge($routeArguments);
            }
        }
        return $attributeArguments;
    }

    public function getControllerClass()
    {
        return $this->route['controller_class'];
    }

    public function getBaseURL()
    {
        return $this->route["controller_args"]["base_url"];
    }

    public function getRouteArgs()
    {
        return $this->route['route_args'];
    }

    public function getRoutes()
    {
        $routes = [];
        foreach ($this->getRouteArgs() as $route) {
            $routeURL = $route['arguments']['url'];
            $requestMethod = $route['arguments']['method'];
            $path = rtrim($this->getBaseURL() . $routeURL, '/');
            $method = $route['route_method']->name; // method / function
            $routes[] = new RoutingRoute(
                $requestMethod,
                $path,
                $this->getControllerClass(),
                $method
            );
        }
        return $routes;
    }
}
