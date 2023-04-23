<?php

namespace App\Http\Controllers;

use App\Mail\OrderStock;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Order $order) {
        Mail::to('convery-j2@ulster.ac.uk')->send(new OrderStock($order));

        return view('email');
    }
}
