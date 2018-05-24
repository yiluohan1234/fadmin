<div class="user-panel">
  <a class="pull-left image" href="{{ route('fadmin.account.info') }}">
    <img src="{{ fadmin_avatar_url(fadmin_auth()->user()) }}" class="img-circle" alt="User Image">
  </a>
  <div class="pull-left info">
    <p><a href="{{ route('fadmin.account.info') }}">{{ Auth::user()->name }}</a></p>
    <small>
        <small>
            <a href="{{ route('fadmin.account.info') }}"><span><i class="fa fa-user-circle-o"></i> {{ trans('base.my_account') }}</span></a> &nbsp;  &nbsp;
            <a href="{{ route('fadmin.auth.logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('base.logout') }}</span></a>
        </small>
    </small>
  </div>
</div>
