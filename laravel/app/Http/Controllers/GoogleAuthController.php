<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        // Retrieve user information from Google
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if a user with the same email exists in the database
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            // If user exists, log them in
            Auth::login($user);
            return redirect('/'); 
        } else {
            // If user does not exist, create a new user
            $newUser = new User();
            $newUser->name = $googleUser->name;
            $newUser->email = $googleUser->email;
            $newUser->username = $googleUser->email; // You can modify this as needed
            $newUser->password = bcrypt('12345678'); // Default password for Google users
            $newUser->save();

            // Log in the new user
            Auth::login($newUser);
            return redirect('/home'); 
        }
    }
}