<?php
namespace Src\Controllers;

use Src\Helpers\Response;

class VersionController {
    public function show() {
        $data = [
            'status' => 'success',
            'version' => '1.0.0',
            'message' => 'API version info'
        ];

        Response::json($data);
    }
}
