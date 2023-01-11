<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if($validator->fails()){
            return response()->json([
               'validation_errors' => $validator->messages()
            ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken($user->email.'_token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $request->name,
                'user_id' => $user->id,
                'token' => $token,
                'message' => 'Registered successfully.',
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()){
            return response()->json([
                'validation_errors' => $validator->messages()
            ]);
        }else{
            $user = User::where('email', $request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials'
                ]);
            }else{
                $token = $user->createToken($user->email.'_token')->plainTextToken;

                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'user_id' => $user->id,
                    'token' => $token,
                    'message' => 'Logged in successfully.',
                ]);
            }
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged out successfully.'
        ]);
    }
}
