<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Complain;


class ComplainController extends Controller
{

    public function index() {
        return Complain::orderBy('id', 'asc')->paginate(90);
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

    
      public function destroy($id)
    {
        $Complain =  Complain::find($id);
        $Complain->delete();
        return ['message' => 'Complaint Deleted'];

    }

}
