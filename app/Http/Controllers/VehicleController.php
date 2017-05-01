<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Cawoch\Http\Controllers\Auth\ResetPasswordController;
use Cawoch\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function create(Request $request)
    {
        $client_id = $request->get('client_id');
        $clients = Client::all()->pluck('id', 'name');
        return view('vehicles.create', compact('clients', 'client_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required|exists:clients,id',
            'serial' => 'required|unique:vehicles'
        ]);
        $vehicle = Vehicle::create($request->all());
        return redirect(route('vehicle.show', $vehicle));
    }

    public function show(Vehicle $vehicle)
    {
        return $vehicle;
    }
}
