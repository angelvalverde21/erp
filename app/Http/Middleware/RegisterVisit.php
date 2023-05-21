<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;

class RegisterVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // $request->headers->add(['Nombre-Encabezado' => 'Valor-Encabezado']);
        $visit = New Visit();

        // $visit->request = $request->headers;
        $visit->ip = $request->ip();
        $visit->refer = $request->url();
        $visit->method = $request->method();
        $visit->request = $request;
        $visit->host = $request->host();

        $visit->save();

        return $next($request);

    }
}
