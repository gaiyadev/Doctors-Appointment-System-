<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use\App\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use\App\Admin;
use\App\User;
use\App\TIME;
use\App\Appointment;
use\App\complain;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
       
    public function __construct()
    {
        $this->middleware('auth:admin');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function fetch() {
        return Admin::all();
    }
//... fetch all appt
    public function allAppointment() {
       return Appointment::paginate(5);
            // $user = Auth::user()->id;
      // return Appointment::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);

    }

     public function seat() {
        return Admin::all();
    }
    
    // public function index() {
    // $user = Auth::user()->id;
    //     return Appointment::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);
    // }


      // creating new users Saving to database
    public function store(Request $request) {        
    //       //creating/saving users to db
    $this->validation($request);
    Admin::create($request->all());
    //return $request->all();    
    return ['message' => 'created user updated'];

    }
    public function validation ($request) {
     return $request->validate([
            'firstname' => 'required|min:3|max:50',            
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:admins|max:255',
            'state' => 'required',
            'specialization' => 'required|min:3|max:255',
            'password' => ['required', 'min:8', 'same:password'],
            'confirmed_password' => ['required', 'min:8', 'same:password'], 
            ]);

 }


    //updating
    public function update(Request $request, $id)
    {
          $user = Admin::find($id);
         $request->validate([
            'firstname' => 'required|min:3|max:50',            
            'lastname' => 'required|max:255',
            'email' => 'required|max:191|email|unique:users,email,' . $user->id,
            'state' => 'required',
            'specialization' => 'required|min:3|max:255',
            'password' => ['required', 'min:8', 'same:password'],
            'confirmed_password' => ['required', 'min:8', 'same:password'], 
            ]);

         //update post
       $Admin =  Admin::find($id);
       $Admin->firstname = $request->input('firstname');
       $Admin->lastname = $request->input('lastname');
       $Admin->email = $request->input('email');
       $Admin->state = $request->input('state');
       $Admin->specialization = $request->input('specialization');      
       $Admin->password = $request->input('password');      
      // $Admin->user_id = auth()->user()->id;
       $Admin->save();
        return ['message' => 'Admin updated'];
    }


    
      public function destroy($id)
    {
        $Admin =  Admin::find($id);
        $Admin->delete();
        return ['message' => 'Admin Deleted'];

    }

    ///
    
      public function destroyA($id)
    {
              //  $this.authorize('isAdmin');
        $Appointment =  Appointment::find($id);
        $Appointment->delete();
        return ['message' => 'Admin Deleted'];

    }

    public function complain() {
        // $user = Auth::user()->id;
        //return Complain::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);
        return Complain::paginate(6);
    }


}
