<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
    	'user_id',
    	'first_name',
    	'last_name',
    	'birthdate',
    	'gender'
    ];

    public function showBirthday($birthdate) {
    	return Carbon::parse($birthdate)->format('d/m/Y');
    }

    public function showGender() {
    	return $this->gender == 1 ? 'Male' : 'Female';
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}