<?php
namespace Src\Middlewares; class CorsMiddleware{
    public static function handle(array $cfg){
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
        $allowed =$cfg['app']['allowed_origins'] ?? [];
        if ($allowed && in_array($origin,$allowed,true)) {
            header("Access-Control-Allow-Origin: $origin");
            header('Vary: Origin');
        }else if (empty($allowed)) {
            header('Access-Control-Allowe-Origin: *');
        }
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Header: Content-Type, Authorization');
        header('Access-Control-Allow-Method: GET,POST,PUT,DELETE,OPTIONS');
    }
}