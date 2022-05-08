<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {

        return view('auth.login');
    }

    public function login(Request $request) {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if (auth("web")->attempt($data)) {
            return redirect(route("timer."));
        }

        return redirect(route("login"))->withErrors(["email" => "Пользователь не найден или неверный пароль"]);
    }

    public function logout() {
        auth("web")->logout();

        return redirect(route('login'));
    }
}
