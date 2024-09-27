<?php

namespace Drogo;

use App\Http\Request;
use Drogo\Response\JsonResponse;

class Http
{
    private static $routes = [];

    public static function get($uri, string $controller, string $method)
    {
        self::addRoute('GET', $uri, [$controller, $method]);
    }

    public static function post($uri, string $controller, string $method)
    {
        self::addRoute('POST', $uri, [$controller, $method]);
    }

    private static function addRoute($method, $uri, $action)
    {
        self::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action
        ];
    }

    public static function dispatch()
    {
        $requestUri = self::getRequestUri();
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && $route['uri'] === $requestUri) {
                if (is_callable($route['action'])) {
                    call_user_func($route['action']);
                } elseif (is_array($route['action'])) {
                    self::callControllerAction($route['action']);
                }
                return;
            }
        }

        echo "404 - Not Found";
    }

    private static function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        return strtok($uri, '?');
    }

    private static function callControllerAction($action)
    {
        list($controller, $method) = $action;
        $controllerInstance = new $controller();

        $reflectionMethod = new \ReflectionMethod($controller, $method);

        if ($reflectionMethod->getNumberOfParameters() > 0) {
            $parameter = $reflectionMethod->getParameters()[0];
            $type = $parameter->getType();

            if ($type && !$type->isBuiltin() && $type->getName() === Request::class) {
                $request = new Request();
                $response = $controllerInstance->$method($request);
            } else {
                $response = $controllerInstance->$method();
            }
        } else {
            $response = $controllerInstance->$method();
        }

        if ($response instanceof JsonResponse) {
            $response->send();
        }
    }
}
