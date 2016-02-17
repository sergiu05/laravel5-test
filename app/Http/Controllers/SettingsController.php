<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class SettingsController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {	
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        return view('settings.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $this->validate($request, [
        	'name' => 'required|max:255',
        	'email' => 'required|email|max:255|unique:users,email,'.$id,
        	'is_subscribed' => 'boolean'
        ]);

        $user = User::findOrFail($id);

        $user->update([
        	'name' => $request->name,
        	'email' => $request->email,
        	'is_subscribed' => $request->is_subscribed
        ]);

        alert()->success('Congrats!', 'You updated ur user settings.');

        return redirect()->action('SettingsController@edit', [$user]);
    }

    
}
