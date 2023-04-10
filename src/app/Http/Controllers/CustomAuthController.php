<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public function signIn()
    {
        return view('signIn');
    }

    public function create()
    {
        return view('createAccount');
    }

    public function createAccount(Request $request)
    {
        echo 'Create user';
    }
}
