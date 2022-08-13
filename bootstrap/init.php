<?php

try {

    session_start();

    require_once __DIR__ . '/../vendor/autoload.php';

    require_once __DIR__ . '/utils.php';

    require_once __DIR__ . '/db.php';

    require_once __DIR__ . '/validator.php';

    require_once __DIR__ . '/Router.php';
    require_once __DIR__ . '/../route/web.php';
    $uri = $_SERVER['REQUEST_URI'];
    if ($pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    Router::execute($_SERVER['REQUEST_METHOD'], $uri);

} catch (Exception $exception) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

    $message = date("Y-m-d H:i:s\t");
    $message .= $exception->getMessage() . ' ';
    $message .= $exception->getFile() . ' ';
    $message .= $exception->getLine() . "\n";
    $message .= $exception->getTraceAsString();
    file_put_contents(__DIR__ . '/../logs/app.log', $message . "\n", FILE_APPEND);

    echo "Bad response.";
}
