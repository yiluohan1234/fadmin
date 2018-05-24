<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $data = []; // the information we send to the view
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $guard = fadmin_guard_name();
        $this->middleware("guest:$guard");
        // Where to redirect users after login / registration.
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo
            : config('fadmin.base.route_prefix', 'dashboard');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user_model_fqn = config('fadmin.base.user_model_fqn');
        $user = new $user_model_fqn();
        $users_table = $user->getTable();
        $email_validation = fadmin_authentication_column() == 'email' ? 'email|' : '';
        return Validator::make($data, [
            'name'                             => 'required|max:255',
            fadmin_authentication_column()   => 'required|'.$email_validation.'max:255|unique:'.$users_table,
            'password'                         => 'required|min:6|confirmed',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user_model_fqn = config('fadmin.base.user_model_fqn');
        $user = new $user_model_fqn();
        return $user->create([
            'name'                             => $data['name'],
            fadmin_authentication_column()   => $data[fadmin_authentication_column()],
            'password'                         => bcrypt($data['password']),
        ]);
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // if registration is closed, deny access
        if (!config('fadmin.base.registration_open')) {
            abort(403, trans('base.registration_closed'));
        }
        $this->data['title'] = trans('base.register'); // set the page title
        return view('auth.register', $this->data);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // if registration is closed, deny access
        if (!config('fadmin.base.registration_open')) {
            abort(403, trans('base.registration_closed'));
        }
        $this->validator($request->all())->validate();
        $this->guard()->login($this->create($request->all()));
        return redirect($this->redirectPath());
    }
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return fadmin_auth();
    }
}
