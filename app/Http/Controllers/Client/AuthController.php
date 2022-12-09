<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView() {
        return view("client.auth.login");
    }

    public function login(LoginRequest $request) {
        $client = User::isClient()->where(function ($query) use ($request) {
            $query->where('mobile', $request->username);
            $query->orWhere('email', $request->username);
        })->first();
        if ($client && Hash::check($request->password, $client->password)) {
            auth()->login($client, $request->has('remember'));
            return redirect(route('client.home'))
                ->with('success-message', __('messages.login-success', ['name' => $client->name]));
        }
        return redirect()->back()->with('error-message' ,__("messages.invalid-credentials"));
    }

    public function logout() {
        auth()->logout();
        return redirect(route("client.home"));
    }
}
