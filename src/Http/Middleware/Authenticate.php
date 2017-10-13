<?php

namespace Pyaesone17\Lapse\Http\Middleware;

use Pyaesone17\Lapse\Lapse;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return Lapse::check($request) ? $next($request) : abort(403);
    }
}