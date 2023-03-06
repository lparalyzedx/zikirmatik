<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_token = $request->header('x-api-token');

        if (!$api_token) {
            return response()->json([
                'status'  => false,
                'message' => 'Yetkisiz istek.',
            ], 403);
        }

        if (!ApiToken::where('token', $api_token)->first()) {
            return response()->json([
                'status'  => false,
                'message' => 'Bu alanı görmeye yetkiniz yok.',
            ], 403);
        }

        return $next($request);
    }
}
