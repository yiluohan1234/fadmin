{{ trans('base.click_here_to_reset') }}: <a href="{{ $link = fadmin_url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
