<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
       // dd($request->remember);
        //Validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        /*//Store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); */   

        //Sign in user
        if (!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid login details, byacht!!');
        }
      
        //Redirect
        return redirect()->route('dashboard');
    }
}
