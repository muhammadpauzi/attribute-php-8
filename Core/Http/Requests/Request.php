<?php

namespace Core\Http\Requests;

final class Request
{
    public function getRequestMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function getPathRequest()
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }
}
