<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('fadmin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('base.dashboard') }}</span></a></li>
{{-- logmanager --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/log') }}'><i class='fa fa-terminal'></i> <span>{{trans('logmanager.logs')}}</span></a></li>
{{-- backup --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>{{trans('backup.backups')}}</span></a></li>

<li><a href="{{ fadmin_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('base.file_manager') }}</span></a></li>

<!-- Users, Roles Permissions -->
  <li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
  </li>
