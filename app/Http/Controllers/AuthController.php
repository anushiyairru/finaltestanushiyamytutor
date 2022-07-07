<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ListItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }


    public function register()
    {
        return view('tutorregistration');
    }


    public function mainpage()
    {
        return view('mainpage');
    }




    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phnum' => 'required',
            'address' => 'required',
            'state' => 'required',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        $check->save();

        return redirect("login")->with('save', 'Success')->withErrors('error', 'Failed');;
    }


    public function create(array $data)
    {
        return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phnum' => $data['phnum'],
            'address' => $data['address'],
            'state' => $data['state'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])

        ]);
    }



    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('mainpage')
                ->with('save', 'Success')->withErrors('error', 'Failed');
        }

        return redirect("login")->withSuccess('You have entered invalid credentials');
    }






    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
