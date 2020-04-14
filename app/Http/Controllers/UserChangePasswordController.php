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
    try {           
       
      $this->validate($request, [
            'old_password' => ['required','min:8'],
            'password' => ['required', 'min:8', 'same:password'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],            
        ]);

        //getting the password of the currently login user
        $hashPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashPassword)) {
            if(strcmp($request->get('old_password'), $request->get('password')) == 0){
                //Current password and new password are same
                  return ['message' => 'new password is the same with the current'];
                //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            } else {
               $user = User::find(Auth::id());
                $user->password = $request->password;
               // print($user->password); die();
                $user->save();
                Auth::logout();
                  return ['message' => 'Password changeed succedssfully'];
               // return redirect()->route('Admin')->with('success', 'Password changed successfully');
            }
        }else {
             return ['message' => 'current password is not d same'];
           // return redirect()->back()->with('error', 'Current Password is not correct. Please try again');
        }
    } catch (Exception $ex) {
     echo "<p><strong>Caught exception:</strong></p> ", $ex->getMessage(), "\n";

    }
}//end
}
