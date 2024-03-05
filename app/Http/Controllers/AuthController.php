<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\UserModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');
            $user = UserModel::where('email', $credentials['email'])->first();

            if($user && $user->is_active !== 0)
            {
                if (Auth::attempt($credentials)) {

                return redirect()->route('dashboard');
                } else {
                    return redirect()->route('login')->with('err', 'Invalid Account Credentials');
                }
            }else{
                return redirect()->route('login')->with('err', "Account isn't Activated Yet!");
            }
            
            
        }else{
            if(Auth::check())
            {
                return back()->with('err', "You're already logged in!");
            }
            else
            {
                return view('login');
            }
        }
    }

    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $formData = $request->all();

            $user = new UserModel([
                'name' => $formData['name'],
                'email' => $formData['email'],
                'password' => bcrypt($formData['password']),
                'token' => $this->generateToken()
            ]);

            if($user -> save())
                { return redirect()->route('login')->with('success', 'User Successfully Registered!'); } 
            else
                { return redirect()->route('login')->with('error', 'User Registration Failed!'); } 
        }else{

            return view('register');
        }
    }

    public function activateAccount(Request $request)
    {
        $token = $request->only('token');

        $user = UserModel::where('token', $token)->first();
        $user->is_active = 1;
        $user->token = null;
        
        if($user->save())
        {
            return redirect()->route('login')->with('success', 'Acoount Activated! You may now login');
        }else{

            return redirect()->route('login')->with('err', 'Failed to Activate Acoount!');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();

        return redirect()->route('login');
    }


    ####################__Helper Functions__###########################

    public function generateToken()
    {
        $token = Str::random(32);
        $rowCount = UserModel::where('token', $token)->count();

        while ($rowCount > 0) 
        {
            $token = Str::random(32);
            $rowCount = UserModel::where('token', $token)->count();
        }

        return $token;
    }
}
