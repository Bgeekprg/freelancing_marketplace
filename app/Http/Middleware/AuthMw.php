<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Cache;
class AuthMw

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path=$request->path();
        if(($path == 'login' || $path == 'register') && Session::get('user'))
        {
            // $response->header->set('Cache-Control','nocache,no-store,max-age-0,must-revalidate');
            // $response->header->set('Pragma','no-cache');
            // $response->header->set('Expires','Sat,01 Jan 2000 00:00:00
            //  GMT');
            return redirect('/');

            
        }
        else if(($path!='login' && !Session::get('user')) && ($path!='register' && !Session::get('user')))
        {
            return redirect('login');
        }        
      
        return $next($request);
    }
}
