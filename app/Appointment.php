<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor', 'email', 'purpose', 'date', 'time',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user () {
    	return $this->belongsTo('App\User');
    }

}
