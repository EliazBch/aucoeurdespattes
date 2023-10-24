<?php

namespace App\Controllers;


class ErrorController extends MainController
{
    public function __construct(){
        $this->view = '404';
        http_response_code(404);
    }
}