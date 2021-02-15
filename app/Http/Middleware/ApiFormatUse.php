<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiFormatUse
{
    public function handle(Request $request, Closure $next)
    {
        // костыли, чтобы Laravel обрабатывал данные по умолчанию как JSON
        $request->headers->set('CONTENT_TYPE', 'application/json');
        $xml = $request->accepts('application/xml') ?? ($request->input('format') == 'xml');
        if (!$xml) {
            $request->headers->set('Accept', 'application/json');
        }

        $response = $next($request);

        return $response;
    }
}
