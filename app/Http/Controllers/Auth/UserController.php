<?php

namespace Cawoch\Http\Controllers\Auth;

use Cawoch\User;
use Illuminate\Http\Request;
use Cawoch\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $auth = auth()->user();
        $this->validate($request, [
            'name' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($auth->id)
            ],
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $auth->name = $request->get('name');
        $auth->email = $request->get('email');
        if ($request->get('password') != null) {
            $auth->password = bcrypt($request->get('password'));
        }
        $auth->save();

        return redirect('home');
    }
}
