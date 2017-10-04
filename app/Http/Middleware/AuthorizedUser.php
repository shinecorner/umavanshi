<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizedUser
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

        $isAuthenticate = $request->session()->get('isAuthenticate');                
        $role = $request->session()->get('role');
        if($isAuthenticate && $role == 'admin'){            
            return $next($request);
        }
        else{                        
            return redirect()->route('show_login');            
        }
        
    }
}
