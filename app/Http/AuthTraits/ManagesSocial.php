<?php

namespace App\Http\AuthTraits;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Exceptions\EmailNotProvidedException;
use App\Exceptions\EmailAlreadyInSystemException;
use App\Exceptions\AlreadySyncedException;
use App\Exceptions\CredentialsDoNotMatchException;
use Redirect;

trait ManagesSocial {

	private function socialUserHasNo($socialUserEmail) {
		return $socialUserEmail === null;
	}

	private function socialUserAlreadyLoggedIn() {
		return Auth::check();
	}

	private function findOrCreateUser($facebookUser) {
		if ($authUser = User::where('email', $facebookUser->email)->first()) {

			if ( ! $authUser->facebook_id == $facebookUser->id) {
				throw new EmailAlreadyInSystemException;	
			}

			return $authUser;
			
		}

		if (User::where('facebook_id', $facebookUser->id)->first()) {
			throw new CredentialsDoNotMatchException;
		}

		$password = $this->makePassword();

		return User::create([
			'name' => $facebookUser->name,
			'email' => $facebookUser->email,
			'password' => $password,
			'status_id' => 10,
			'facebook_id' => $facebookUser->id,
			'avatar' => $facebookUser->avatar
		]);

	}

	private function makePassword() {
		return bcrypt(rand().str_random(8));
	}

	private function userSyncedOrSync($facebookUser) {
		if ($this->userSynced($facebookUser)) {
			throw new AlreadySyncedException;
		} else {
			$id = Auth::user()->id;

			$user = User::findOrFail($id);

			$user->update([
				'facebook_id' => $facebookUser->id,
				'avatar' => $facebookUser->avatar
			]);


			alert()->overlay('Congrats!', 'You are now synced', 'success');		

			return $this->redirectUser();
		}
	}

	private function userSynced($facebookUser) {
		$authUser = User::where('email', $facebookUser->email)->first();

		return ($authUser->facebook_id == $facebookUser->id) ? true : false;
	}

	private function redirectUser() {
		if (Auth::user()->isAdmin()) {
			return redirect()->route('admin');
		}

		return redirect()->route('home');
	}


}
