<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
     <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
      @if (config('fadmin.base.setup_auth_routes'))
        @if (fadmin_auth()->guest())
            <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/login') }}">{{ trans('base.login') }}</a></li>
            @if (config('fadmin.base.registration_open'))
            <li><a href="{{ route('fadmin.auth.register') }}">{{ trans('base.register') }}</a></li>
            @endif
        @else
            <li><a href="{{ route('fadmin.auth.logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('base.logout') }}</a></li>
        @endif
       @endif
       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>