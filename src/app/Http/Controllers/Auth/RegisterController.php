<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Actions\Fortify\CreateNewUser;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.register');
    }
    public function store(RegisterRequest $request) {
        $data = $request->validated();
        $user = app(CreateNewUser::class)->create($data);
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }


}
