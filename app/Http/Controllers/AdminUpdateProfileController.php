<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminUpdateProfileController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin');
    }

     //
    public function show() {
        $user = Auth::getUser('admin');
        return  $user;

    }

     // Saving to database
    public function updateInfo(Request $request, $id) {
         $user = Admin::find($id);
         $request->validate([
             'firstname' => 'required|min:3|max:50',            
            'lastname' => 'required|min:3|max:55',
            'specialization' => 'required',
            'email' => 'required|max:191|email|unique:users,email,' . $user->id,
            
            
]);

          //saving to db
       $Admin =  Admin::find($id);
       $Admin->firstname = $request->input('firstname');
       $Admin->lastname = $request->input('lastname');
       $Admin->specialization = $request->input('specialization');
       $Admin->email = $request->input('email');
       $Admin->save();

        return ['message' => 'user info updated'];

    }
}
