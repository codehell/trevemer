<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        return $client;
    }
}
