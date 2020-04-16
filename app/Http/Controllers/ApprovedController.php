<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Appointment;


class ApprovedController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //
    public function approve(Request $request, $id) {
       $appointment = Appointment::find($id);
     $approveValue = $request->status;
        if ($approveValue === 'on') {
            $approveValue = 1;
        } else if ($approveValue === 'off'){
            $approveValue = 0;
        }else {
            
        }
        return dd($appointment->status); die;
      $appointment->status = $approveValue;
        $appointment->save();
//return 'approve';
    }
}
