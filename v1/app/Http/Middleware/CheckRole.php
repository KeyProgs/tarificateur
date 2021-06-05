<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole {
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
   public function handle($request, Closure $next) {

      $user = User::findOrFail(Auth::user()->id);
      if(!$user->isRole("admin") && !$user->isRole("supervisor")&& !$user->isRole("agent")) {

         abort(403);
      }
      return $next($request);
   }
}
