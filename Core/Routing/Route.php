<?php

namespace Core\Routing;

use Core\Http\Controllers\BaseController;

final class Route
{
    public function __construct(
        private string $requestMethod,
        private string $path,
        private $controller,
        private $method
    ) {
    }

    public function getRequestMethod(): string
    {
        return strtoupper($this->requestMethod);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getInstanceController()
    {
        return new $this->controller;
    }
}
