<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Error & Exception handler
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    echo "<b>Error:</b> $errstr in <b>$errfile</b> on line <b>$errline</b><br>";
});
set_exception_handler(function($e) {
    echo "<pre>";
    print_r($e);
    echo "</pre>";
});

// Autoload class
spl_autoload_register(function($c){
    $p = __DIR__ . '/..';
    $c = str_replace('\\','/',$c);
    $paths = ["$p/src/$c.php", "$p/$c.php"];
    foreach($paths as $f){ 
        if(file_exists($f)) require $f;
    }
});

// Load config
$cfg = require __DIR__ . '/../config/env.php';

use Src\Helpers\Response;
use Src\Middlewares\CorsMiddleware;

// Versi API
$apiVersion = '1.0.0';

// Handle CORS preflight
CorsMiddleware::handle($cfg);
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { 
    http_response_code(204); 
    exit;
}

// Routing
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path = '/' . trim(str_replace($base, '', $uri), '/');
$method = $_SERVER['REQUEST_METHOD'];

// Daftar route
$routes = [
    ['GET', '/api/v1/health', 'Src\\Controllers\\HealthController@show'],
    ['POST', '/api/v1/auth/login', 'Src\\Controllers\\AuthController@login'],
    ['GET', '/api/v1/users', 'Src\\Controllers\\UserController@index'],
    ['GET', '/api/v1/users/{id}', 'Src\\Controllers\\UserController@show'],
    ['POST', '/api/v1/users', 'Src\\Controllers\\UserController@store'],
    ['PUT', '/api/v1/users/{id}', 'Src\\Controllers\\UserController@update'],
    ['DELETE', '/api/v1/users/{id}', 'Src\\Controllers\\UserController@destroy'],
    ['POST', '/api/v1/upload', 'Src\\Controllers\\UploadController@store'],
    ['GET', '/api/v1/version', 'Src\\Controllers\\VersionController@show'],
];

// Fungsi pencocokan route
function matchRoute($routes, $method, $path) {
    foreach($routes as $r){
        [$m, $p, $h] = $r;
        if($m !== $method) continue;
        $regex = preg_replace('#\{[^/]+\}#', '([\\w-]+)', $p);
        if(preg_match('#^' . $regex . '$#', $path, $mch)){
            array_shift($mch);
            return [$h, $mch];
        }
    }
    return [null, null];
}

[$handler, $params] = matchRoute($routes, $method, $path);

// Jika route tidak ditemukan (404)
if (!$handler) {
    $error = [
        'code' => 404,
        'message' => 'Route not found',
        'version' => $apiVersion
    ];
    Response::json(['success' => false, 'error' => $error], 404);
    exit;
}

// Jika method tidak ada (405)
[$class, $action] = explode('@', $handler);
if (!method_exists($class, $action)) {
    $error = [
        'code' => 405,
        'message' => 'Method not allowed',
        'version' => $apiVersion
    ];
    Response::json(['success' => false, 'error' => $error], 405);
    exit;
}

// Jalankan controller yang cocok
call_user_func_array([new $class($cfg), $action], $params);
