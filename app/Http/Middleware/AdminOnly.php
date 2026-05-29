<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdmin()) {
            return redirect()
                ->route('generate-id.index')
                ->with('error', 'You do not have permission to access that page.');
        }

        return $next($request);
    }
}
