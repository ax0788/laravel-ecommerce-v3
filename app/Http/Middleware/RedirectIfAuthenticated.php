<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\User;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $expireTime = Carbon::now()->addSeconds(30);
                Cache::put('user-is-online' . Auth::user()->id, true, $expireTime);
                User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);

                $role = $request->user()->role;
                switch ($role) {
                    case 'admin':
                        return redirect(route('admin.dashboard'));
                        break;
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}