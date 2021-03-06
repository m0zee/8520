<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsProfileCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $user = Auth::user();
        
        if( $user->user_type_id == 2 )
        {
            if( ! $user->detail )
            {
                return redirect( route( 'profile.create' ) )->with( 'error','Please complete your profile first.' );
            }
        }
        
        return $next($request);
    }
}
