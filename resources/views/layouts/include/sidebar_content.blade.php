@can('dashboard')
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('fadmin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('base.dashboard') }}</span></a></li>
@endcan

@can('log_manager')
{{-- logmanager --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/log') }}'><i class='fa fa-terminal'></i> <span>{{trans('logmanager.logs')}}</span></a></li>
@endcan

@can('backup_manager')
{{-- backup --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>{{trans('backup.backups')}}</span></a></li>
@endcan

@can('file_manager')
<li><a href="{{ fadmin_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('base.file_manager') }}</span></a></li>
@endcan

@can('permission_manager')
<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>{{trans('permissionmanager.users')}}</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>{{trans('permissionmanager.roles')}}</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>{{trans('permissionmanager.permission_plural')}}</span></a></li>
    </ul>
</li>
@endcan

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Blog</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ fadmin_url('article') }}"><i class="fa fa-newspaper-o"></i> <span>Articles</span></a></li>
      <li><a href="{{ fadmin_url('category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
      <li><a href="{{ fadmin_url('tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>data monitor</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ fadmin_url('article') }}"><i class="fa fa-newspaper-o"></i> <span>data</span></a></li>
      <li><a href="{{ fadmin_url('category') }}"><i class="fa fa-list"></i> <span>picture</span></a></li>
    </ul>
</li>

