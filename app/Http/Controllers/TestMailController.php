<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function sendMail() {
        Mail::to('fourmoonside@gmail.com')
        ->send(new TestMail());
    }
}
