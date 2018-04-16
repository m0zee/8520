<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsBuyer
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
        if( Auth::user()->user_type_id == 1 )
        {
            return $next( $request );
        }
        elseif( $request->ajax() )
        {
            $response = [ 'status' => 'error', 'message' => 'This functionality is available only for buyers.' ];
            
            return response( $response, \Illuminate\Http\Response::HTTP_FORBIDDEN );
        }

        return redirect( '/' )->with( 'error', 'You are not authorized for this action' );
    }
}
