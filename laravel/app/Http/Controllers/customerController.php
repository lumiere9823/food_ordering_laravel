<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerController extends Controller
{
    public function show(){
        return view('FrontEnd.customer.register');
    }
}
