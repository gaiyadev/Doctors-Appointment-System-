<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Admin;



class AppointmentController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

     public function seat() {
        return Admin::all();
    }
    

    public function index() {
    $user = Auth::user()->id;
        return Appointment::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);
    }

     // Saving to database
    public function store(Request $request) {
         $request->validate([
             'email' => 'required|min:3|max:50',            
            'doctor' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'purpose' => 'required|min:3|max:255',
]);

          //saving to db
       $Appointment = new Appointment;
       $Appointment->email = $request->input('email');
       $Appointment->doctor = $request->input('doctor');
       $Appointment->date = $request->input('date');
       $Appointment->time = $request->input('time');
       $Appointment->purpose = $request->input('purpose');
       $Appointment->user_id = auth()->user()->id;
       $Appointment->save();

        return ['message' => 'Post updated'];

    }


    //updating
    public function update(Request $request, $id)
    {
         $request->validate([
             'email' => 'required|min:3|max:50',            
            'doctor' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
            'purpose' => 'required|min:3|max:255',
            ]);

         //update post
       $Appointment =  Appointment::find($id);
       $Appointment->email = $request->input('email');
       $Appointment->doctor = $request->input('doctor');
       $Appointment->date = $request->input('date');
       $Appointment->time = $request->input('time');
       $Appointment->purpose = $request->input('purpose');
       $Appointment->user_id = auth()->user()->id;
       $Appointment->save();
        return ['message' => 'Post updated'];
    }


        // public function getEmail () {
        //             return  Auth::user()->email;
        // }


      public function destroy($id)
    {
        $Appointment =  Appointment::find($id);
        $Appointment->delete();
        return ['message' => 'Post Deleted'];

    }
}
