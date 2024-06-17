<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $req)
    {
        $password = Hash::make($req->input('password'));
        $user = User::create([
            'name'=>$req->input('name'),
            'email'=> $req->input('email'),
            'password'=>$password,
            'email_verified_at'=>date('Y-m-d H:i:s')
        ]);

        if(!empty($user))
        {
            return ["state"=>true, "message"=>"User Created"];
        }
        return ["state"=>false];
    }

    public function details(Request $req)
    {
        // $user = $req->user('api');
        // if(!empty($user))
        // {
        //     return ['state'=>true, 'msg'=>$user];
        // }
        $user = Auth::user();
        return $user;
    }
}
