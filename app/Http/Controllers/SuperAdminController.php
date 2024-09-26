<?php

namespace App\Http\Controllers;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function superadminregister(Request $req)
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

        $superadmin = new SuperAdmin;
        $superadmin->name = $req->input('name');
        $superadmin->email = $req->input('email');
        $superadmin->password = Hash::make($req->input('password'));
        $superadmin->save();

        return response()->json($superadmin,201);
    }

    public function superadminlogin(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',

        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $superadmin = SuperAdmin::where('email', $req->email)->first();
        if(!$superadmin || !Hash::check($req->password, $superadmin->password))
        {
            return response()->json(['error' => 'Invalid email or password'],401);
        }
        
        return response()->json($superadmin, 200);
        
    }

}
