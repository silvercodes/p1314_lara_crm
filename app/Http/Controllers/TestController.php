<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test()
    {
        // dd(Auth::user()->can('p_3'));
    }
}
