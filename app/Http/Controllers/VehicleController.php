<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Cawoch\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function create()
    {
        $clients = Client::all()->pluck('id', 'name');
        return view('vehicles.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        return redirect(route('vehicle.show', $vehicle));
    }

    public function show(Vehicle $vehicle)
    {
        return $vehicle;
    }
}
