<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $data = []; // the information we send to the view
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
    use AuthenticatesUsers {
        logout as defaultLogout;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $guard = fadmin_guard_name();
        $this->middleware("guest:$guard", ['except' => 'logout']);
        // ----------------------------------
        // Use the admin prefix in all routes
        // ----------------------------------
        // If not logged in redirect here.
        $this->loginPath = property_exists($this, 'loginPath') ? $this->loginPath
            : fadmin_url('login');
        // Redirect here after successful login.
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo
            : fadmin_url('dashboard');
        // Redirect here after logout.
        $this->redirectAfterLogout = property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout
            : fadmin_url();
    }
    /**
     * Return custom username for authentication.
     *
     * @return string
     */
    public function username()
    {
        return fadmin_authentication_column();
    }
    /**
     * Log the user out and redirect him to specific location.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Do the default logout procedure
        $this->guard()->logout();
        // And redirect to custom location
        return redirect($this->redirectAfterLogout);
    }
    /**
     * Get the guard to be used during logout.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return fadmin_auth();
    }
    // -------------------------------------------------------
    // Laravel overwrites for loading fadmin views
    // -------------------------------------------------------
    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $this->data['title'] = trans('base.login'); // set the page title
        $this->data['username'] = $this->username();
        return view('auth.login', $this->data);
    }
}
