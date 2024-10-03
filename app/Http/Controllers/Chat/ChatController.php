<?php

namespace App\Http\Controllers\Chat;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function message(Request $req)
    {
        event(new Message($req->input('username'), $req->input('message') ));
        
        return [];
    }
}
