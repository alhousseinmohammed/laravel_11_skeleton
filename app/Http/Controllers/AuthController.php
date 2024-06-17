<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
            'email' => ['required', 'email'],
            'password' => ['required'],
            ]
        );

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('/login')->withInput()->with('login_failed', 1);
    }

    public function getToken(Request $request)
    {
        $request->validate(
            [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(
                [
                'email' => ['The provided credentials are incorrect.'],
                ]
            );
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
