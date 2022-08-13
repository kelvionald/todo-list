<?php


class Router
{
    private static $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function add($httpMethod, $pattern, $controllerClass, $action): void
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$httpMethod][$pattern] = [$controllerClass, $action];
    }

    public static function execute($httpMethod, $url): void
    {
        if ($url == '') {
            $url = '/';
        }
        foreach (self::$routes[$httpMethod] as $pattern => $controllerAction) {
            if (preg_match($pattern, $url, $params)) {
                array_shift($params);
                $controller = new $controllerAction[0]();
                echo call_user_func_array([$controller, $controllerAction[1]], array_values($params));
                return;
            }
        }
        throw new Exception('Not found.');
    }
}
