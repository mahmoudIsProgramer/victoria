<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        if (Auth::guard($guard)->check()) {
            return redirect('admin.add_student');
        }
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('admin/add_student');
                }
                break;
            case 'doctor':
                if (Auth::guard($guard)->check()) {
                    // return redirect()->route('doctor.dashboard');
                }
                break;
            case 'consultant':
                if (Auth::guard($guard)->check()) {
                    // return redirect()->route('consultant.dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
            }


        return $next($request);
    }
}
