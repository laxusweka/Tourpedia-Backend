<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class ApiUserController extends Controller
{
    public function about_me(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['email', 'required'],
                'password' => 'required'
            ]);

            //$credentials = request(['email', 'password']);
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication failed', 500);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success(
                [
                    'access_token' => $token,
                    'user' => $user
                ],
                'User Registered'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', new Password],
                ]
            );

            User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'roles' => 'USER'
                ]
            );

            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success(
                [
                    'access_token' => $token,
                    'user' => $user
                ],
                'User Registered'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something wrong',
                    'error' => $error
                ],
                'Auth Gagal',
                500
            );
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token, 'Token Revoked');
    }
}
