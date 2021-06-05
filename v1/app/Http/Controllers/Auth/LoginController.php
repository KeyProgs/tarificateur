<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

   use AuthenticatesUsers;

   /**
    * Where to redirect users after login.
    *
    * @var string
    */


   //protected $redirectTo = '/accueil';
   public function redirectTo() {
      // User role
      $role = Auth::user()->role->valeur;

      // Check user role
      switch($role) {
         case 'admin':
            return '/tableau-bord';
            break;
         case 'supervisor':
            return '/tableau-bord';
            break;
         default:
            return '/fiches/etat/1';
            break;
      }
   }

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct() {
      $this->middleware('guest')->except('logout');
   }
}
