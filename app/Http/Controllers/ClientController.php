<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'snd_last_name' => 'required',
            'id_card' => 'required',
            'phone' => 'required_without:mobile',
            'email' => 'unique:clients',
        ]);
        $client = Client::create($request->all());
        return redirect(route('order.create', $client))->with('success');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'snd_last_name' => 'required',
            'id_card' => 'required',
            'phone' => 'required_without:mobile',
            'email' => [Rule::unique('clients')->ignore($client->id)],
        ]);

        $client->update($request->all());
        return redirect(route('client.edit', $client))
            ->with('success', __('app.client.update_success', ['name' => $client->name]));
    }
}
