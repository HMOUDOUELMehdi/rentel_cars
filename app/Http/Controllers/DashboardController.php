<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function fetchAllUsers(){
        $users =  User::all();
        return view('dashboard.allUsers',compact('users'));
    }
    public function destroyUsers($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/');
//        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }



}
