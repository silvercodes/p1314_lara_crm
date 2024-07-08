<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiUnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $role, $permission = null): Response
    {
        $user = Auth::user();

        if (! ($user && $user->hasRoles($role)))
            if ($permission === null || $user->cannot($permission))
                throw new ApiUnauthorizedException();       // TODO: throw 403

        return $next($request);
    }
}
