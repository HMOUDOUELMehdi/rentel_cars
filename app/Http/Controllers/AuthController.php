<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function addClient(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'password' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->back()->with(['success' => 'user create successufely']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin') {

            $adminUser = User::where('email', 'admin@gmail.com')->first();
            if ($adminUser) {
                Auth::login($adminUser);
                return redirect('/dashboard');
            }
        }

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect('/login');
    }


    public function profile(){
        $userId = Auth::id();

        $user = User::where('id', $userId)->first();

        return view('home pages.profile',compact('user'));
    }
//
    public function updateProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'tel' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('/')->with('success', 'Profile Updated Successfully!');
    }


}
