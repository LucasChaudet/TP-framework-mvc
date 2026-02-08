<?php

namespace App\Controller;

use IIA\Framework\Controller\Controller;

class AppController extends Controller
{
    public function __construct()
    {
        $this->viewPath = __DIR__ . "/../Views/";
        $this->template = "base";
    }
}