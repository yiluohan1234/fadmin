<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('fadmin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('base.dashboard') }}</span></a></li>
{{-- logmanager --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/log') }}'><i class='fa fa-terminal'></i> <span>{{trans('logmanager.logs')}}</span></a></li>
{{-- backup --}}
<li><a href='{{ url(config('fadmin.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>{{trans('backup.backups')}}</span></a></li>

<li><a href="{{ fadmin_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('base.file_manager') }}</span></a></li>
