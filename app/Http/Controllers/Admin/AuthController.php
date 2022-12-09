<?php

namespace App\Http\Controllers\Admin;

use App\Enum\UserEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
    public function loginView() {
        if (auth()->check()) return redirect(route("admin.home"));
        return view("admin.login");
    }

    public function login(LoginRequest $request) {
        $login = auth()->guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'user_role' => UserEnum::admin_role
        ], $request->has("remember"));
        if ($login) return redirect(route("admin.home"));
        return redirect()->back()->with("error-message", __("messages.invalid-credentials"));
    }

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect(route("admin.login"));
    }
}
