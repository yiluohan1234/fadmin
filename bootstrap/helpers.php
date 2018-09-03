<?php
if (!function_exists('fadmin_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     *
     * @return string
     */
    function fadmin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new \Illuminate\Support\MessageBag(get_defined_vars());

        \Illuminate\Support\Facades\Session::flash('toastr', $toastr);
    }
}

if (!function_exists('get_db_config')){
    function get_db_config()
    {
        if (getenv('IS_IN_HEROKU')) {
            $url = parse_url(getenv("DATABASE_URL"));

            return $db_config = [
                'connection' => 'pgsql',
                'host' => $url["host"],
                'database'  => substr($url["path"], 1),
                'username'  => $url["user"],
                'password'  => $url["pass"],
            ];
        } else {
            return $db_config = [
                'connection' => env('DB_CONNECTION', 'mysql'),
                'host' => env('DB_HOST', 'localhost'),
                'database'  => env('DB_DATABASE', 'forge'),
                'username'  => env('DB_USERNAME', 'forge'),
                'password'  => env('DB_PASSWORD', ''),
            ];
        }
    }
}

if (!function_exists('ts')){
    function ts($code, $lang='zh'){
        $lang = empty($lang)?'zh':$lang;
        $code = preg_replace('/[^0-9a-zA-z.-_ ]/', '', $code);
        $trans = trans($code,[],'',$lang);
        if (empty($trans) || $trans == $code){
            $trans = ucwords(preg_replace('/([0-9a-zA-z-_ ]*[.])*/', '', $code));
        }
        return $trans;
    }
 }

if (!function_exists('fadmin_url')) {
    /**
     * Appends the configured fadmin prefix and returns
     * the URL using the standard Laravel helpers.
     *
     * @param $path
     *
     * @return string
     */
    function fadmin_url($path = null)
    {
        $path = !$path || (substr($path, 1, 1) == '/') ? $path : '/'.$path;
        return url(config('fadmin.base.route_prefix', 'admin').$path);
    }
}
if (!function_exists('fadmin_authentication_column')) {
    /**
     * Return the username column name.
     * The Laravel default (and fadmin default) is 'email'.
     *
     * @return string
     */
    function fadmin_authentication_column()
    {
        return config('fadmin.base.authentication_column', 'email');
    }
}
if (!function_exists('fadmin_users_have_email')) {
    /**
     * Check if the email column is present on the user table.
     *
     * @return string
     */
    function fadmin_users_have_email()
    {
        $user_model_fqn = config('fadmin.base.user_model_fqn');
        $user = new $user_model_fqn();
        return \Schema::hasColumn($user->getTable(), 'email');
    }
}
if (!function_exists('fadmin_avatar_url')) {
    /**
     * Returns the avatar URL of a user.
     *
     * @param $user
     *
     * @return string
     */
    function fadmin_avatar_url($user)
    {
        $placeholder = 'https://placehold.it/160x160/00a65a/ffffff/&text='.$user->name[0];
        switch (config('fadmin.base.avatar_type')) {
            case 'gravatar':
                if (fadmin_users_have_email()) {
                    return Gravatar::fallback('https://placehold.it/160x160/00a65a/ffffff/&text='.$user->name[0])->get($user->email);
                } else {
                    return $placeholder;
                }
                break;
            case 'placehold':
                return $placeholder;
                break;
            default:
                return method_exists($user, config('fadmin.base.avatar_type')) ? $user->{config('fadmin.base.avatar_type')}() : $user->{config('fadmin.base.avatar_type')};
                break;
        }
    }
}
if (!function_exists('fadmin_middleware')) {
    /**
     * Return the key of the middleware used across fadmin.
     * That middleware checks if the visitor is an admin.
     *
     * @param $path
     *
     * @return string
     */
    function fadmin_middleware()
    {
        return config('fadmin.base.middleware_key', 'admin');
    }
}
if (!function_exists('fadmin_guard_name')) {
    /*
     * Returns the name of the guard defined
     * by the application config
     */
    function fadmin_guard_name()
    {
        return config('fadmin.base.guard', config('auth.defaults.guard'));
    }
}
if (!function_exists('fadmin_auth')) {
    /*
     * Returns the user instance if it exists
     * of the currently authenticated admin
     * based off the defined guard.
     */
    function fadmin_auth()
    {
        return \Auth::guard(fadmin_guard_name());
    }
}
if (!function_exists('fadmin_user')) {
    /*
     * Returns back a user instance without
     * the admin guard, however allows you
     * to pass in a custom guard if you like.
     */
    function fadmin_user()
    {
        return fadmin_auth()->user();
    }
}
