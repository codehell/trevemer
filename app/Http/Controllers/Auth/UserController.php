<?php

namespace Cawoch\Http\Controllers\Auth;

use Cawoch\User;
use Illuminate\Http\Request;
use Cawoch\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request)
    {
        auth()->user()->update($request->all());
        return redirect('home');
    }
}
