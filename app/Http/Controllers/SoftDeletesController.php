<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class softDeletesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Get Soft Deleted User.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDeletedUser($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->get();
        if (count($user) !== 1) {
            flash('User not found!');
            return redirect('/users/deleted/');
        }

        return $user[0];
    }

    public function index()
    {
        $users = User::onlyTrashed()->get();
        $roles = Role::all();

        trail('Deleted user: ', 'view deleted users listing');
        return View('users.show-deleted-users', compact('users', 'roles'));
    }

    public function show($id)
    {
        $user = self::getDeletedUser($id);

        trail('Deleted user: ', 'view deleted user');
        return view('users.show-deleted-user')->withUser($user);
    }

    public function update(Request $request, $id)
    {
        $user = self::getDeletedUser($id);
        $user->restore();

        trail('Restore:', 'restore deleted user');
        flash('User restored successfully')->important();
        return redirect('/users/');
    }

    public function destroy($id)
    {
        $user = self::getDeletedUser($id);
        $user->forceDelete();

        trail('Deleted users: ', 'permanently delete user');
        flash('User successfully deleted')->info();
        return redirect('/users/deleted/');
    }
}
