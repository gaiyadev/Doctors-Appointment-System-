<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Complain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class ComplainController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index() {
         $user = Auth::user()->id;
        return Complain::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);
        //return Complain::orderBy('id', 'asc')->paginate(90);
    }
    
     // Saving to database
    public function store(Request $request) {
         $request->validate([
             'subject' => 'required|min:3|max:150',            
            'complain' => 'required|min:10|max:255',
            ]);

          //saving to db
       $Complain = new Complain;
       $Complain->subject = $request->input('subject');
       $Complain->complain = $request->input('complain');
       $Complain->user_id = auth()->user()->id;
       $Complain->save();

        return ['message' => 'complain succedssfully'];

    }

    
      public function destroy($id)    {        
        $Complain =  Complain::find($id);
      //  dd($Complain); die;
        $Complain->delete();
        return ['message' => 'Complaint Deleted'];

    }

}
