<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class UserUpdateProfileController extends Controller
{
    //
    public function show() {
        return  Auth::user();

    }

     // Saving to database
    public function updateInfo(Request $request, $id) {
         $request->validate([
             'firstname' => 'required|min:3|max:50',            
            'lastname' => 'required|min:3|max:55',
            'dob' => 'required',
            'email' => 'required',
]);

          //saving to db
        $User =  User::find($id);
       $User->firstname = $request->input('firstname');
       $User->lastname = $request->input('lastname');
       $User->dob = $request->input('dob');
       $User->email = $request->input('email');
       $User->save();

        return ['message' => 'user info updated'];

    }

}
