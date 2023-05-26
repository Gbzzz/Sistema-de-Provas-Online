<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

// use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'terms' => 'required'
        ]);

        if($request->tipoAcesso == 1){
            $userDocente = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'docente' => true,
                'FirstAccess' => true,
            ]);

            event(new Registered($userDocente));
        }
        else{
            $userDiscente = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'discente' => true,
                'FirstAccess' => true,
            ]);

            event(new Registered($userDiscente));
        }


        return redirect('/dashboard');
    }
}
