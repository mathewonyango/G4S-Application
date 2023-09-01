<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index()
    {
        $user = User::all();

        trail('Settings-view', 'view profile');
        return view('settings.profile', compact('user'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        trail('Avatar Change', 'change user image(avatar)');

        $user = user();

        $avatarName = $user->id. '_avatar'.time(). '.' .request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars', $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        flash('Avatar changed successfully')->important();
        return back();
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        trail('change password', 'change user(own) password');

        flash('password changed successfully')->important();
        return redirect()->route('settings.profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
