<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'], // 'user' or 'admin
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role, // 'user' or 'admin
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        return response($user, 200);
    }

    public function show(User $user)
    {

        return response($user, 200);
    }
    
    public function showAllUsers()
    {
        $users = User::all();

        return response($users,200);
    }

    public function update(Request $request, User $user) 
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'role' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255',  Rule::unique('users', 'email')->ignore($user),],
            'password' => ['nullable','confirmed', Rules\Password::defaults()],
        ]);

        $user->update($request->all());

        return response($user, 204);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->noContent();
    }
}
