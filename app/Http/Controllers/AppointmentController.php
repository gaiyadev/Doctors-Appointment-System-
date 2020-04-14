<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Appointment;
use Illuminate\Support\Facades\Auth;



class AppointmentController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
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
}
