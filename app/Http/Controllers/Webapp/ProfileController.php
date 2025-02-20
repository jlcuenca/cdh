<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Webapp/Profile/Index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required|string',
            'email' => "required|email|unique:users,email,$user->id",
        ]);

        $password = $request->get('password', null);

        if (!is_null($password)) {
            $user->password = Hash::make($password);
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $user->save();

        return response()->json($user, 200);
    }
}
