<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        User::create($data);

        return redirect()->route('login');
    }

    public function registerPage()
    {
        return Inertia::render('Auth/Register');
    }
}
