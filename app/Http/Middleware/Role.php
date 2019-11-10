<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = [])
    {
        $roles = explode('|', $roles);
        $user = \Auth::user();

        foreach($roles as $role) {
            if($user->role === $role) {
                return $next($request);
            }
        }

        return redirect()->route('food.index');
    }
}
