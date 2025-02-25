<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class CheckAuthenticated
{
    public function handle($request, Closure $next)
    {
        try {
            auth()->shouldUse('admin');
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        } catch (Exception $e) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return $next($request);
    }
}
