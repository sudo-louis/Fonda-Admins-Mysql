<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\login;

class LoginAdminsController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = \App\Models\login::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['error' => 'El usuario no existe'], 404);
        }

        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'La contraseña es incorrecta'], 401);
        }

        try {
            if (!$token = auth('admin')->attempt($credentials)) {
                return response()->json([
                    'error' => 'No se pudo generar el token',
                    'debug' => [
                        'guard' => auth()->getDefaultDriver(),
                        'provider' => auth('admin')->getProvider()->getModel(),
                        'usuario_encontrado' => $user ? true : false,
                        'password_correcta' => Hash::check($credentials['password'], $user->password),
                    ]
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al generar el token', 'exception' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Sesión cerrada exitosamente']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo cerrar sesión'], 500);
        }
    }

    public function me()
    {
        return response()->json([
            'user' => JWTAuth::parseToken()->authenticate()
        ]);
    }
}
