<?php

namespace Cawoch\Http\Controllers;

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
            'phone' => 'required_without:mobile',
            'email' => 'unique:clients',
        ]);
        $client = Client::create($request->all());
        return redirect(route('order.create', $client))->with('success');
    }

    public function show(Client $client)
    {
        return $client;
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
            'phone' => 'required_without:mobile',
            'email' => [Rule::unique('clients')->ignore($client->id)],
        ]);

        $client->update($request->all());
        return redirect(route('client.edit', $client))
            ->with('success', trans('app.client.update_success', ['name' => $client->name]));
    }
}
