<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Ip_adresse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Hconnexion;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
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
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
//        $this->checkIpAdresse($request);


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    use AuthenticatesUsers;


    protected function checkIpAdresse(Request $request)
    {
        $adresse_ip = $_SERVER['REMOTE_ADDR'];
        $authorizedIpAdresse = Ip_adresse::where('adresse_ip', '=', $adresse_ip)->first();
        Hconnexion::create(['email' => $request->email, 'adresse_ip' => $adresse_ip]);
        if ($authorizedIpAdresse != null) {
            //abort(403);
        } else {
            abort(403);
        }

    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    //protected $redirectTo = '/accueil';
    public function redirectTo()
    {
        // mail config
        /*$oClient = new \Webklex\IMAP\Client([
            'host' => 'poulpe.o2switch.net',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => Auth::user()->email,
            'password' => Auth::user()->email_password,
            'protocol' => 'imap'
        ]);
        $oClient->connect();
        if (!$oClient->connection) {
            dd('not good');
        } else {
            //return $oClient->connect();
            dd('good');
        }*/
        $oClient = new \Webklex\IMAP\Client([
            'host' => 'poulpe.o2switch.net',
            'port' => 993,
            'encryption' => 'ssl',
            'validate_cert' => true,
            'username' => Auth::user()->email,
            'password' => Auth::user()->email_password,
            'protocol' => 'imap'
        ]);
        $oClient->connect();

        if (!$oClient->connection) {
            Session::flash('message-email', 'Votre adresse mail ' . Auth::user()->email . ' n\'est pas configé');
            Session::flash('alert-class-mail', 'alert-danger');
            Session::put('imap', null);
            Session::put('Imap_Folders', null);

        } else {
            //$oClient->connect();
            $aFolder = $oClient->getFolders();
            Session::put('imap', $oClient);
            Session::put('Imap_Folders', $aFolder);
        }

        //Check user role
        $role = Auth::user()->role->valeur;
        switch ($role) {
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
