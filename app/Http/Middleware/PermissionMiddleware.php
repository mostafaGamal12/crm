<?php


namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        $authGuard = app('auth')->guard('api');
        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);
        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}