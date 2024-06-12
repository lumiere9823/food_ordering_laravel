<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Mail;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->validated());

        auth()->login($user);

        $data = $user->toArray();

        Mail::send('FrontEnd.mail.welcome_mail',$data,function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Welcome to our site');
        });

        return redirect('/')->with('success', "Account successfully registered.");
    }
}