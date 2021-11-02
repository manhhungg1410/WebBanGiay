<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->isGuest()){
                alert()->warning('Tài khoản của bạn không có quyền truy cập vào trang này');
                return redirect()->route('admin_login');
            }
            return $next($request);
        }
        return redirect()->route('admin_login');
  //      return $next($request);
    }
}
