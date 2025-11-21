<?php
namespace Src\Middlewares; use Src\Helpers\Response; use Src\Helpers\Jwt;
class AuthMiddleware{
    public static function user(array $cfg){
        $hdr=$_SERVER['HTTP_AUTHORIZATION']??'';
        if(!preg_match('/Bearer\s+(.*)/')) Response::jsonerror(401, 'Missing token');
            $pl=jwt::verify($m[1],$cfg['app']['jwt_secret']); if(!$pl)
            Response::jsonerror(401, 'Invalid/expired token'); return $pl; }
            public static function admin(array $cfg){ $pl=self::user($cfg);
        if(($pl['role']??'user')!=='admin') Response::jsonError(403,'Forbidden');
        return $pl;}
}