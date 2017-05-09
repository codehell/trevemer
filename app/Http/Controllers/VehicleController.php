<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Cawoch\Http\Controllers\Auth\ResetPasswordController;
use Cawoch\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

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
            'serial' => 'required|unique:vehicles',
            'plate' => 'required|unique:vehicles',
        ]);
        $vehicle = Vehicle::create($request->all());
        return redirect(route('vehicle.show', $vehicle));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validate($request, [
            'client_id' => 'required|exists:clients,id',
            'serial' => ['required', Rule::unique('vehicles')->ignore($vehicle->id)],
            'plate' => ['required', Rule::unique('vehicles')->ignore($vehicle->id)],
        ]);
        $vehicle->update($request->all());
        return redirect(route('vehicle.edit', $vehicle));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }
}
