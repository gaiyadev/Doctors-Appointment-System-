<?php

namespace App\Http\Controllers;
namespace App\Appointment;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search () {
        if ($search = \Request::get('q')) {
            $appointment = Appointment::where(function($query) use ($search){
                $query->where('doctor', 'LIKE', '%$search%' )
                ->orWhere('email', 'LIKE', '%$search%');

            })->paginate(7);
    }
    return $appointment;
}
}
