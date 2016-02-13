<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\AuthTraits\OwnsRecord;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, OwnsRecord;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 
            'email', 
            'is_subscribed',
            'is_admin',
            'user_type_id',
            'status_id',
            'password'        
        ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function widgets() {

    	return $this->hasMany('App\Widget');

    }

    public function isAdmin() {

        return 1 == \Auth::user()->is_admin;

    }

    public function isActiveStatus() {

        return 10 == \Auth::user()->status_id;

    }
}
