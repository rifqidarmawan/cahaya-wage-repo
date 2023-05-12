<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store (Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => ['required','string', 'regex:/^[0-9\-\+\(\)\/\s]*$/'],
            'address' => 'required|string|max:500',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
       ]);

    //    $validatedData['password'] = bcrypt($validatedData['password']);
       $registration = new User;

       $registration->name = $validatedData['name'];
       $registration->username = $validatedData['username'];
       $registration->phone_number = $validatedData['phone_number'];
       $registration->address = $validatedData['address'];
       $registration->email = $validatedData['email'];
       $registration->password = Hash::make($validatedData['password']);
       $registration->roles = 0;

       $registration->save();
    //    User::create($validatedData);

       return redirect('/login')->with('success', 'Registration Successfull! Please login');
    }
}
