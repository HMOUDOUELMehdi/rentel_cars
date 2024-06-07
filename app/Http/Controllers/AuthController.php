<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'password' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect('/login');
    }

//
//    public function showProfileForm(){
//        $userId = Auth::id();
//        $userName = Auth::user()->name;
//
//        $user = User::where('id', $userId)->first();
//
//        return view('auth.profile',compact('userId','userName','user'));
//    }
//
//    public function updateProfile(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required',
//            'email' => 'required|email|unique:users,email,' . Auth::id(),
//            'password' => 'required',
//            'rank' => 'required',
//        ]);
//
//        $user = User::find(Auth::id());
//        $user->update($validatedData);
//
//        return redirect()->route('home')
//            ->with('success', 'Profile Updated Successfully!');
//    }

}
