<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login($userid,$password) {
        $u = null;

        // Mencari user berdasarkan userid
        // $u = User::where('userid', $userid)->orWhere('email',$userid)->first();
        $u = (User::where('userid', $userid)->orWhere('email',$userid)->get());
        if (!isset($u[0])) {
            return null;
        }
        else{
            $u = $u[0];
        }

        // Jika password cocok
        if (Hash::check($password, $u->password)) {
            
            session([
                'user' => $u
            ]);
        }
        else $u = null;
        
        

        return $u;
    }
}
