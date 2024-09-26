<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminregister(Request $req)
    {

        $validator = Validator::make($req->all(),[
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',  
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $admin = new Admin;
        $admin->name = $req->input('name');
        $admin->email = $req->input('email');
        $admin->password = Hash::make($req->input('password'));
        $admin->save();
       
        return response()->json($admin,201);
    }

    public function adminlogin(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',

        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $admin = Admin::where('email',$req->email)->first();
        if(!$admin || !Hash::check($req->password,$admin->password))
        {
            return response()->json(['error' => 'Invalid email or password'],401);
        }
        return response()->json($admin, 200);     
    }

   
}
