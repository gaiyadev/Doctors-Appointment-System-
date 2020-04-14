<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordController extends Controller
{
     /**

     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function changePassword(Request $request)
    {          
       
      $this->validate($request, [
            'old_password' => ['required','min:8'],
            'password' => ['required', 'min:8', 'same:password'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],            
        ]);

        //getting the password of the currently login user
        $hashPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashPassword)) {
           if(Hash::check($request->password, $hashPassword)){
                //Current password and new password are same
                 // return ['message' => 'new password is the same with the current'];
                 return response()->json(['error' => ['current' => ['new password is the same with the current password']]], 422);
            }else {
               $user = User::find(Auth::id());
                $user->password = $request->password;
                $user->save();
                Auth::logout(); 
                return ['message' => 'Password changeed successfully'];  
               }
        }else {
          return response()->json(['error' => ['current' => ['Old password is not the same with the one in the database']] ], 422);
        }
}
}
