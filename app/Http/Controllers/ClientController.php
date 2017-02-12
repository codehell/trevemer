<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'email' => 'unique:clients'
        ]);
        $client = Client::create($request->all());
        return redirect(route('order.create', $client))->with('success');
    }
}
