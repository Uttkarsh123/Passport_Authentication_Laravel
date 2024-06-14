<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function create(Request $req)
    {
        $user = $request->user("api");
        if(!empty($user))
        {
            
        }
    }
}
