<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        // die;
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        $validated = null;
    	try {
    		$val = Validator::make((array) $request->all(),[
                'userid' => 'required|string|max:255|unique:users,userid',
                'firstname' => 'required|string|max:255',
                'lastname' => 'string|max:255',
                'email' => 'required|string|email|unique:sqlanywhere.users',
                'groupid' => 'required|string|exists:sqlanywhere.usergroups,id',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
	            'password_confirm' => ['required', 'same:password']
	    	]);
	    	$validated = $val->validate();
    	} catch (ValidationException $e) {
    		return ([
    			'success' => false,
    			'message' => "Register New Group Failed",
    			'errors' => $e->validator->errors()->all()
    		]);
    		
    	}
        // die;
        
        // Buat user baru
        $user = User::create([
            'userid' => $request->userid,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'groupid' => $request->groupid,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Return response sukses
        return response()->json([
            'message' => 'User berhasil didaftarkan dengan id: ' . $user->id
        ], 201);
    }

    public function changepassword(Request $request)
    {

	    $validator_param = [
	        'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
	        'password_confirm' => ['required', 'same:password']
	    ];
    	if ($request->userid == null) {
    		$user = $request->user();
            $validator_param['password_current'] = 'required';
    	}
    	else{
    		$validator_param ['userid'] = 'required|exists:sqlanywhere.users,userid';
    	}


    	# catch some validator error
    	try {
    		$val = Validator::make((array) $request->all(),$validator_param);
	    	$validated = $val->validate();

            $user = (User::where('userid',$request->userid)->get())[0];
    		
    	} catch (ValidationException $e) {
    		return ([
    			'success' => false,
    			'message' => "Update Failed",
    			'errors' => $e->validator->errors()->all()
    		]);
    	}

    	# catch update 
    	try {
    		
    		if (Hash::check($request->password_current, $user->password)) {
			    $user->password = $request->password;
			    $user->save();
			    return ([
    			'success' => true,
    			'message' => "Change Password Success",
    			
    			
    			
    		]);
			}
			else return ([
    			'success' => false,
    			'message' => "Change Password Failed",
    			// 'details' => "Your current password is wrong"
    			
    			
    		]);

    	} catch (\Illuminate\Database\QueryException $e) {
    		return ([
    			'success' => false,
    			'message' => "Update Failed",
    			'errors' => "Internal Server Error"
    			// 'errors' => $e->getMessage()
    		]);
    	}
    	
    	
    }
}
