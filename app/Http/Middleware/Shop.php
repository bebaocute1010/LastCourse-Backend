<?php

namespace App\Http\Middleware;

use App\Utils\MessageResource;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Shop
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
        if (!auth()->user()->shop) {
            return JsonResponse::error(MessageResource::NO_SHOP, JsonResponse::HTTP_CONFLICT);
        }
        return $next($request);
    }
}
