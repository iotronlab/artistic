<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof JsonResponse && config('app.debug') && $request->has('_debug')) {
            // $response->setData($response->getData(true) + [
            //     '_debug' => app('debugbar')->getData()
            // ]);
        }
        return $response;
    }
}
