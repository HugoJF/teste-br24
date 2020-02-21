<?php

namespace App\Http\Middleware;

use Closure;

class VerifyBitrixAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = $request->query('auth.application_token');
        $token = config('bitrix24.auth_token');

        if ($auth === $token) {
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
