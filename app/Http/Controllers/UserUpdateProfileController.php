<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class UserUpdateProfileController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function show() {
        return  Auth::user();

    }

     // Saving to database
    public function updateInfo(Request $request, $id) {
        $user = User::find($id);
         $request->validate([
             'name' => 'required|min:3|max:50',            
            'lastname' => 'required|min:3|max:55',
            'dob' => 'required',
            'email' => 'required|max:191|email|unique:users,email,' . $user->id,
            
            
]);

          //saving to db
      $User =  User::find($id);
       $User->name = $request->input('name');
       $User->lastname = $request->input('lastname');
       $User->dob = $request->input('dob');
       $User->email = $request->input('email');
       $User->save();

        return ['message' => 'user info updated'];

    }

}
