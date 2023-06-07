<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $allowedDomains = [
            'https://ara.pe',
            'https://www.ara.pe',
            'http://ara.pe',
            'http://www.ara.pe',
        ];

        $origin = $request->header('Origin');
        
        if (in_array($origin, $allowedDomains)) {
            $headers = [
                'Access-Control-Allow-Origin' => $origin,
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'Content-Type, X-Requested-With',
            ];
        } else {
            $headers = [];
        }

        if ($request->isMethod('OPTIONS')) {
            return response()->json(['method' => 'OPTIONS'], 200, $headers);
        }

        $response = $next($request);
        
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
