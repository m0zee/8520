<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLogin
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
        if ( Auth::check() )
        {
            return $next($request);
        }
        elseif( $request->ajax() )
        {
            $response = [ 'status' => 'error', 'message' => 'You are not logged in. Please login to perform this action' ];
            
            return response( $response, \Illuminate\Http\Response::HTTP_FORBIDDEN );
        }

        return redirect( '/login' )->with( 'error', 'You are not loggedin.' );
    }
}
