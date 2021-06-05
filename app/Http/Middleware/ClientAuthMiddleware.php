<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ClientAuthMiddleware {
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
   public function handle($request, Closure $next) {
      if(!$request->session()->exists('client')) {
         return redirect()->route('login.client');
      }
      return $next($request);
   }
}
