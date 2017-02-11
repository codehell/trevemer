<?php

namespace Cawoch\Http\Controllers\Auth;

use Cawoch\User;
use Illuminate\Http\Request;
use Cawoch\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect('home');
    }
}
