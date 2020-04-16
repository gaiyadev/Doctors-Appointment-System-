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
    //|| $approveValue == 0
    public function approve(Request $request, $id) {
       $appointment = Appointment::find($id);
       $approveValue = $request->status;
       
        if ($approveValue === null ) {
            $approveValue = 1;
        } else if ($approveValue === 0){
            $approveValue = 1;
        }else {
            
        }
      $appointment->status = $approveValue;
        $appointment->save();
        return 'approve';
    }
}
