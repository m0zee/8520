<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsVendorApproved
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

        if( $user->approved_at == null )
        {
            return redirect()->route( 'vendor.dashboard' )->with( 'error', 'You cannot add produts because the admin has not approved you.' );
        }

        return $next($request);
    }
}
