<?php

namespace App\Controllers;

use Framework\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response('<h1>Home Page</h1>');
    }

    public function about(): Response
    {
        return new Response('About Page');
    }
}