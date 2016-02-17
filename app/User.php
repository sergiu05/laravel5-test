<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\AuthTraits\OwnsRecord;
use App\Http\Requests\UserRequest;
use App\ModelTraits\HasModelTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, OwnsRecord, HasModelTrait;

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
            'facebook_id',
            'avatar',
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

    public function profile() {
    	return $this->hasOne('App\Profile');
    }

    public function updateUser($user, UserRequest $request) {
    	return $user->update([
    		'name' => $request->name,
    		'email' => $request->email,
    		'is_subscribed' => $request->is_subscribed,
    		'is_admin' => $request->is_admin,
    		'user_type_id' => $request->user_type_id,
    		'status_id' => $request->status_id
    	]);
    }

    public function showNewsletterStatusOf($user) {
    	return $user->is_subscribed == 1 ? 'Yes' : 'No';
    }

    public function showAdminStatusOf($user) {
    	return $this->is_admin ? 'Yes' : 'No';
    }

    public function showTypeOf($user) {
    	switch($user->user_type_id) {
    		case 10:
    			return 'Free';
    			break;
    		case 20:
    			return 'Paid';
    			break;
    		default:
    			return 'Free';
    			break;
    	}
    }
}
