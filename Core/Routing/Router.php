<?php

namespace Core\Routing;

use Core\Http\Controllers\BaseController;
use ReflectionObject;
use TypeError;

final class Router
{
    /**
     * @var ReflectionObject[]
     */
    private array $reflections;

    public function registerControllers(array $controllers): void
    {
        foreach ($controllers as $controller) {
            if (!($controller instanceof BaseController))
                throw new TypeError("Controller type must instance of BaseController");

            $this->reflections[] = new ReflectionObject($controller);
        }
    }

    /**
     * @return ReflectionObject[]
     */
    public function getControllerReflectionObjects()
    {
        return $this->reflections;
    }
}
