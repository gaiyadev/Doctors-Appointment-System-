<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TIME;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Admin;
use App\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class TimeController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin');
    }


     public function index() {
        $user = Auth::user()->id;
        return TIME::where('user_id', $user)->orderBy('id', 'asc')->paginate(4);
    }
    

    //
     // Saving to database
    public function store(Request $request) {
         $request->validate([
             'time' => 'required|min:3|max:50',            
            'date' => 'required',
]);

          //saving to db
       $time = new TIME;
       $time->time = $request->input('time');
       $time->date = $request->input('date');
       $time->user_id = auth()->user()->id;
       $time->save();

        return ['message' => 'time Save'];

    }

    //updating
    public function update(Request $request, $id)
    {
         $request->validate([
             'time' => 'required|min:3|max:50',            
            'date' => 'required',
            ]);

         //update post
       $time =  TIME::find($id);
       $time->time = $request->input('time');
       $time->date = $request->input('date');
       $time->user_id = auth()->user()->id;
       $time->save();
        return ['message' => 'Post updated'];
    }

    
      public function destroy($id)
    {
        $TIME =  TIME::find($id);
        $TIME->delete();
        return ['message' => 'Post Deleted'];

    }
}
