<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Request;
use LRedis;

class SocketController extends Controller
{
    public function index()
    {
        return view('socket');
    }

    public function writeMessage() {
        return view('writemessage');
    }

    public function sendMessage() {
        $redis = LRedis::connection();
        $redis->publish('chat', Request::input('content'));
        return "true";
    }
}
