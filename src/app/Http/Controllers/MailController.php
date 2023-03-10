<?php

namespace App\Http\Controllers;

use App\Mail\OrderStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail() {
        Mail::to('convery-j2@ulster.ac.uk')->send(new OrderStock());

        return view('email');
    }
}
