@extends('layouts.layout')

@section('header')
    <section class="content-header">
      <h1>
        <span class="text-capitalize">entity_name_plural </span>
        <small>{{ trans('backpack::crud.all') }} <span>entity_name_plural</span> {{ trans('crud.in_the_database') }}.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix'), 'dashboard') }}">{{ trans('crud.admin') }}</a></li>
        <li><a href="crud->route" class="text-capitalize">entity_name_plural</a></li>
        <li class="active">{{ trans('crud.list') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <a href="http://crud.test/admin/permission/create" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Add permission</span></a>
          <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
        </div>
        <div id="toolbar">
          <select class="form-control">
            <option value="">当前页</option>
            <option value="all">全部</option>
            <option value="selected">选中</option>
          </select>
        </div>
        <table id="table"></table>



      </div><!-- /.box -->
    </div>

  </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

  <link rel="stylesheet" href="/fadmin/css/crud.css">
  <link rel="stylesheet" href="/fadmin/css/form.css">
  <link rel="stylesheet" href="/fadmin/css/list.css">
  <link href="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet">
  <script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
  <script type="text/javascript">
  $('#table').bootstrapTable({
      url: '/admin/permission/data',           //请求后台的URL
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
          field: 'update_date',
          sortable: true,
          title: '更新时间'
      }, {
          field: 'file_type',
          sortable: true,
          title: '文件类型'
      }, {
          field: 'file_num',
          sortable: true,
          title: '文件数量'
      }, {
          field: 'space_size',
          sortable: true,
          title: '文件大小'
      }, {
          field: 'exec_time',
          sortable: true,
          title: '执行时间'
      }, ]
  });
  </script>
@endsection

@section('after_scripts')
  <script src="/fadmin/js/crud.js"></script>
  <script src="/fadmin/js/form.js"></script>
  <script src="/fadmin/js/list.js"></script>
@endsection
