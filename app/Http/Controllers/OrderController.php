<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Vehicle;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request, Vehicle $vehicle)
    {
        return $vehicle;
    }
}
