@can('dashboard')
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('fadmin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('base.dashboard') }}</span></a></li>
@endcan

{{-- data monitor --}}
<li class="treeview">
    <a href="#"><i class="fa fa-database"></i> <span>{{trans('monitor.data monitor')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ route('table') }}"><i class="fa fa-file-text-o"></i> <span>{{trans('monitor.data_update')}}</span></a></li>
      <li><a href="{{ route('picture') }}"><i class="fa fa-bar-chart"></i> <span>{{trans('monitor.picture')}}</span></a></li>
      <li><a href="{{ route('map') }}"><i class="fa fa-pie-chart"></i> <span>map</span></a></li>
    </ul>
</li>

{{-- wiki manamger --}}
@can('wiki_manager')
<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Wiki</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ fadmin_url('article') }}"><i class="fa fa-newspaper-o"></i> <span>{{trans('blogs.Articles')}}</span></a></li>
      <li><a href="{{ fadmin_url('category') }}"><i class="fa fa-list"></i> <span>{{trans('blogs.Categories')}}</span></a></li>
      <li><a href="{{ fadmin_url('tag') }}"><i class="fa fa-tag"></i> <span>{{trans('blogs.Tags')}}</span></a></li>
    </ul>
</li>
@endcan


@can('file_manager')
<li><a href="{{ fadmin_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('base.file_manager') }}</span></a></li>
@endcan


{{-- log manager --}}
@can('log_manager')
{{-- logmanager --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/log') }}'><i class='fa fa-terminal'></i> <span>{{trans('logmanager.logs')}}</span></a></li>
@endcan

{{-- backup manager --}}
@can('backup_manager')
{{-- backup --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>{{trans('backup.backups')}}</span></a></li>
@endcan

{{-- permission manager --}}
@can('permission_manager')
<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>{{trans('permissionmanager.users')}}, {{trans('permissionmanager.roles')}}, {{trans('permissionmanager.permission_plural')}}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>{{trans('permissionmanager.users')}}</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>{{trans('permissionmanager.roles')}}</span></a></li>
      <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>{{trans('permissionmanager.permission_plural')}}</span></a></li>
    </ul>
</li>
@endcan

@can('setting_manager')
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin') . '/setting') }}'><i class='fa fa-cog'></i> <span>{{trans('base.Settings')}}</span></a></li>
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin') . '/link') }}'><i class='fa fa-external-link'></i> <span>{{trans('base.Links')}}</span></a></li>
@endcan

<li class="header">友情链接</li>
<li><a href="http://layer.layui.com/" target="_blank"><i class="fa fa-align-justify"></i> <span>layer</span></a></li>
<li><a href="http://fontawesome.dashgame.com/" target="_blank"><i class="fa fa-dribbble"></i> <span>icons</span></a></li>
<li><a href="https://laravel-china.org/docs/laravel/5.5" target="_blank"><i class="fa fa-file"></i> <span>laravel5.5</span></a></li>

