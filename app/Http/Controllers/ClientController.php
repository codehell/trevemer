<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Phone;
use Cawoch\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->get('search');
            $clients = Client::search($search);
        } else {
            $clients = Client::orderBy('id', 'desc')->paginate();
        }

        return view('clients.index', compact('clients', 'search'));
    }

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
            'id_card' => 'required|unique:clients',
            'phone' => 'required',
            'email' => 'unique:clients',
        ]);
        $client = Client::create($request->except('phone'));
        $phone = new Phone(['number' => $request->get('phone')]);
        $client->phones()->save($phone);
        return redirect(route('client.show', $client))
            ->with('success', trans('app.client.create_success'));
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
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
            'id_card' => ['required', Rule::unique('clients')->ignore($client->id)],
            'email' => [Rule::unique('clients')->ignore($client->id)],
        ]);

        $client->update($request->all());
        return redirect(route('client.edit', $client))
            ->with('success', trans('app.client.update_success', ['name' => $client->name]));
    }
}
