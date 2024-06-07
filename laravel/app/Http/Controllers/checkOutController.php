<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkOutController extends Controller
{
    public function check(){
        return \view('FrontEnd.checkout.checkout');
    }
}
