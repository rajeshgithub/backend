<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function gitcallback()  {
        $user = Socialite::driver('github')->user();
            if ($user->email) {
                $user = User::firstOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'password' => 'password',
                ]);
        
                Auth::login($user);
                return redirect('/dashboard');
            }
            else
            {
                return redirect('/dashboard');
            }
    }
}
