<div class="box">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ fadmin_avatar_url(fadmin_auth()->user()) }}">
        <h3 class="profile-username text-center">{{ fadmin_auth()->user()->name }}</h3>
    </div>

    <hr class="m-t-0 m-b-0">

    <ul class="nav nav-pills nav-stacked">

      <li role="presentation"
        @if (Request::route()->getName() == 'fadmin.account.info')
        class="active"
        @endif
        ><a href="{{ route('fadmin.account.info') }}">{{ trans('base.update_account_info') }}</a></li>

      <li role="presentation"
        @if (Request::route()->getName() == 'fadmin.account.password')
        class="active"
        @endif
        ><a href="{{ route('fadmin.account.password') }}">{{ trans('base.change_password') }}</a></li>

    </ul>
</div>
