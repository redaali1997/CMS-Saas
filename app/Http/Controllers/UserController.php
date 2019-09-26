<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function admin(User $user){
        $user->role = 'admin';
        $user->save();

        session()->flash('success', 'User has been admin.');

        return redirect()->back();
    }
}
