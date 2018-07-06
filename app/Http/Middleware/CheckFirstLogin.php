<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckFirstLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user && !$user->isActivated())
        {
            return redirect()->route('user.changepasswordform')
                ->with([
                    'notice' => 'Es nesesario que cambie su contraseña antes de continuar. ',
                ]);
        }
        return $next($request);
    }
}
