<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Fecades\Auth;
use Tymon\JWTAuth\Fecades\JWTAuth;
use Illuminate\support\frecades\Validator;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $validador = Validator::make ($request -> all(),[
            'email' => 'require|email',
            'passaword'=> 'required',
        ]);
        if($validador ->fails()){
            return response()->json(['errors'=> $validador -> errors()],422);
        }
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credenciales)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login correcto',
            'token' => $token,
            'user'=>auth('api')-> user(),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
    }
}