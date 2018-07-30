@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{ trans('logs.log_show') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">{{ trans('logs.log_show') }}</li>
      </ol>
    </section>
@stop
@section('content')
    <!-- Main content -->
   <div class="box">
        <div class="box-body">
          <div id="toolbar">
            <select class="form-control">
              <option value="">{{trans('monitor.export_basic')}}</option>
              <option value="all">{{trans('monitor.export_all')}}</option>
              <option value="selected">{{trans('monitor.export_selected')}}</option>
            </select>
          </div>
          <table id="table"></table>

         </div>
    </div>
    <!-- /.content -->
@stop
@section('after_scripts')
<link href="https://cdn.bootcss.com/bootstrap-table/1.12.1/bootstrap-table.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-table/1.12.1/bootstrap-table.js"></script>
@if(env('APP_LOCALE') == 'zh-CN')
<script src="https://cdn.bootcss.com/bootstrap-table/1.12.1/locale/bootstrap-table-zh-CN.min.js"></script>
@endif
<link href="https://cdn.bootcss.com/bootstrap-table/1.12.1/bootstrap-table.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-table/1.12.1/extensions/export/bootstrap-table-export.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.12.1/extensions/export/bootstrap-table-export.min.js"></script>
<script src="/fadmin/js/tableExport.js"></script>

<script type="text/javascript">
$('#table').bootstrapTable({
    url: '/admin/monitor/log/show',           //请求后台的URL
    toolbar:'#toolbar',
    singleSelect:false,
    clickToSelect:true,                 //是否启用点击选中行
    sortName: "update_date",
    sortOrder: "desc",                  //排序方式
    pageSize: 7,                        //每页的记录行数
    pageNumber: 1,                      //初始化加载第一页，默认第一页
    pageList: "[7, 14, 30, 100, All]",  //可供选择的每页的行数
    showToggle: false,                  //是否显示详细视图和列表视图的切换按钮
    cardView: false,                    //是否显示详细视图
    detailView: false,                  //是否显示父子表
    showRefresh: true,                  //是否显示刷新按钮
    showColumns: true,                  //是否显示所有的列
    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
    showExport: true,                   //是否显示导出
    exportDataType: "basic",            //basic', 'all', 'selected'.
    striped: true,                      //是否显示行间隔色
    search: true,
    pagination: true,                   //是否显示分页
    columns: [{
        field: "state",
        checkbox:true,
    },{
        field: 'user_name',
        sortable: true,
        title: '{{trans('logs.user_name')}}'
    }, {
        field: 'action_time',
        sortable: true,
        title: '{{trans('logs.action_time')}}'
    }, {
        field: 'action',
        sortable: true,
        title: '{{trans('logs.action')}}'
    }, {
        field: 'content',
        sortable: true,
        title: '{{trans('logs.content')}}'
    },{
        field: 'ip',
        sortable: true,
        title: '{{trans('logs.ip')}}'
    }, {
        field: 'address',
        sortable: true,
        title: '{{trans('logs.address')}}'
    },{
        field: 'device',
        sortable: true,
        title: '{{trans('logs.device')}}'
    },{
        field: 'browser',
        sortable: true,
        title: '{{trans('logs.browser')}}'
    }, {
        field: 'platform',
        sortable: true,
        title: '{{trans('logs.platform')}}'
    }, {
        field: 'language',
        sortable: true,
        title: '{{trans('logs.language')}}'
    }, {
        field: 'device_type',
        sortable: true,
        title: '{{trans('logs.device_type')}}'
    },  ]
});
</script>

@stop
