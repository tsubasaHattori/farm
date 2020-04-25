<?php

namespace App\Http\Controllers\hoge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HogeController extends Controller
{
    public function hoge() {
        return view('hoge');
    }
}
