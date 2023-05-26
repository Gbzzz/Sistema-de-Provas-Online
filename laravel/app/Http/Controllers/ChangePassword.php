<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Controller
{
    protected $user;

    public function __construct()
    {
        Auth::logout();

        $id = intval(request()->id);
        $this->user = User::find($id);
    }

    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:8'],
            'confirm-password' => ['same:password']
        ]);

        $existingUser = User::where('email', $attributes['email'])->first();
            if ($existingUser) {
                if ($existingUser->FirstAccess) {
                    $existingUser->update([
                        'password' => $attributes['password'],
                        'FirstAccess' => false
                    ]);
                    return redirect('login');
                } else {
                    return redirect('/dashboard');
                }
            } else {
                return redirect('/dashboard');
            }
        }
    }

