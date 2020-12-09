<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$roles)
    {

        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();
        foreach($roles as $role) {
            if($user->hasRole($role))
                return $next($request);
        }

        /*if ($user->role_id == 1 ){
            return $next($request);
        }*/

       /* if (Auth::guard($guard)->check()) {
            $user = Auth::user();
          //  $user_role = Role::where('id',$user->role_id)->first();
            if ($user->role_id == 5 ){
                return $next($request);
            }
        }*/
        return redirect('/home_page');
    }
}
