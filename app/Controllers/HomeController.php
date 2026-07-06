<?php

namespace Sendity\Controllers;

use Sendity\Http\Response;

class HomeController
{
    public function index(): Response
    {
        return Response::text('Sendity is running');
    }

    public function health(): Response
    {
        return Response::text('OK');
    }
}