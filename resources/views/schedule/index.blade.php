@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{trans('schedule.Task schedules')}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li><a href="{{ route('fadmin.schedule.index') }}">{{trans('schedule.Task schedules')}}</a></li>
        <li class="active">{{trans('schedule.list')}}</li>
      </ol>
    </section>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
              <!-- /.box-header -->
              <div class="box-body no-padding">
                  <table class="table table-striped table-hover">
                      <tbody>
                      <tr>
                          <th style="width: 10px">#</th>
                          <th>{{trans('schedule.Task')}}</th>
                          <th>{{trans('schedule.Run at')}}</th>
                          <th>{{trans('schedule.Next run time')}}</th>
                          <th>{{trans('schedule.Description')}}</th>
                          <th>{{trans('schedule.Run')}}</th>
                      </tr>
                      @foreach($events as $index => $event)
                      <tr>
                          <td>{{ $index+1 }}.</td>
                          <td><code>{{ $event['task']['name'] }}</code></td>
                          <td><span class="label label-success">{{ $event['expression'] }}</span>&nbsp;{{ $event['readable'] }}</td>
                          <td>{{ $event['nextRunDate'] }}</td>
                          <td>{{ $event['description'] }}</td>
                          <td><a class="btn btn-xs btn-primary run-task" data-id="{{ $index+1 }}">Run</a></td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
              <!-- /.box-body -->
          </div>

          <div class="box box-default output-box hide">
              <div class="box-header with-border">
                  <i class="fa fa-terminal"></i>

                  <h3 class="box-title">Output</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <pre class="output-body"></pre>
              </div>
              <!-- /.box-body -->
          </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('after_styles')
<link rel='stylesheet' href='/fadmin/nprogress/nprogress.css'/>
<style>
    .output-body {
        white-space: pre-wrap;
        background: #000000;
        color: #00fa4a;
        padding: 10px;
        border-radius: 0;
    }
</style>
@endsection
@section('after_scripts')
<script src="/fadmin/nprogress/nprogress.js"></script>
<script type="text/javascript">
  $(function () {
      $('.run-task').click(function (e) {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var id = $(this).data('id');
          NProgress.start();
          $.ajax({
              method: 'POST',
              url: '/admin/schedule/run',
              data: {id: id},
              success: function (data) {
                  if (typeof data === 'object') {
                      $('.output-box').removeClass('hide');
                      $('.output-box .output-body').html(data.data);
                  }
                  NProgress.done();
              }
          });
      });
  });
</script>
@endsection
