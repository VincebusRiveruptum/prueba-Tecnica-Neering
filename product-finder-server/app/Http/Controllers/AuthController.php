<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use \stdClass;

class AuthController extends Controller
{
    // Store new user
    public function register(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
        ]);

        try {           
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($validated['password']),
                'profilepic' => null,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'success' => 'true',
            ], 201);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => "Couldn't register user : " . $e->getMessage(),
                    'success' => 'false',
                ],
                400
            );
        }
    }

    // Login
    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            Auth::attempt($validated);

            $user = User::where('email', $validated['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            // set user active
            $user->active = true;
            $user->save();

            return response()->json([
                'message' => 'Hi ' . $user->name,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                'success' => 'true',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unauthorized : ' . $e->getMessage(),
                'success' => 'false',
            ], 401);
        }
    }

    // Logout
    public function logout(){
        try{
            auth()->user()->tokens()->delete();

            // set user inactive
            auth()->user()->active = false;
            auth()->user()->save();
            
            return response()->json([
                'message' => 'You have successfully logged out.',
                'success' => 'true'
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'Loggin out not possible : ' . $e->getMessage(),
                'success' => 'false'
            ], 200);
        }
    }
}
