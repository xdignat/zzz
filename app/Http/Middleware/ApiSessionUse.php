<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ApiSession;

class ApiSessionUse
{
    public function handle(Request $request, Closure $next)
    {
        //Разкоментироать, чтобы отключить сессии
        //return $next($request);

        $response = ApiSession::responseCheck();
        $response = $response ?? $next($request);
        return $response;
    }
}
