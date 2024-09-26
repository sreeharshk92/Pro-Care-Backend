<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255','unique:users,',
            'password' => 'required|string|max:8',

        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }

        $user = new User;
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return response()->json($user,201);
    }

    public function login(Request $req)
    {

        $validator = Validator::make($req->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',

        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],400);
        }

        $user = User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->password))
        {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return response()->json($user, 200);    
    }


    public function usersList()
    {
        return User::all();
    }

    public function deleteUser($id)
    {
        $result = User::where('id',$id)->delete();
        if($result)
        {
            return ['result' => 'User has been deleted'];
        }else{
            return ['result' => 'User already deleted'];
        }
    }

    public function searchUser($key)
    {
        return User::where('name','Like',"%$key%")->get();
    }


}
