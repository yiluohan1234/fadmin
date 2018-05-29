@extends('layouts.layout')
@section('title', trans('logmanager.logs'))
@section('header')
    <section class="content-header">
      <h1>
        {{ trans('logmanager.log_manager') }}<small>{{ trans('logmanager.log_manager_description') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('fadmin.base.route_prefix'),'dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li><a href="{{ url(config('fadmin.base.route_prefix', 'admin').'/log') }}">{{ trans('logmanager.log_manager') }}</a></li>
        <li class="active">{{ trans('logmanager.existing_logs') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ trans('logmanager.file_name') }}</th>
            <th>{{ trans('logmanager.date') }}</th>
            <th>{{ trans('logmanager.last_modified') }}</th>
            <th class="text-right">{{ trans('logmanager.file_size') }}</th>
            <th>{{ trans('logmanager.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($files as $key => $file)
          <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td>{{ $file['file_name'] }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($file['last_modified'])->formatLocalized('%d %B %Y') }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($file['last_modified'])->formatLocalized('%H:%M') }}</td>
            <td class="text-right">{{ round((int)$file['file_size']/1048576, 2).' MB' }}</td>
            <td>
                <a class="btn btn-xs btn-default" href="{{ url(config('fadmin.base.route_prefix', 'admin').'/log/preview/'. base64_encode($file['file_name'])) }}"><i class="fa fa-eye"></i> {{ trans('logmanager.preview') }}</a>
                <a class="btn btn-xs btn-default" href="{{ url(config('fadmin.base.route_prefix', 'admin').'/log/download/'.base64_encode($file['file_name'])) }}"><i class="fa fa-cloud-download"></i> {{ trans('logmanager.download') }}</a>
                <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url(config('fadmin.base.route_prefix', 'admin').'/log/delete/'.base64_encode($file['file_name'])) }}"><i class="fa fa-trash-o"></i> {{ trans('logmanager.delete') }}</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
  jQuery(document).ready(function($) {
    // capture the delete button
    $("[data-button-type=delete]").click(function(e) {
        e.preventDefault();
        var delete_button = $(this);
        var delete_url = $(this).attr('href');
        if (confirm("{{ trans('logmanager.delete_confirm') }}") == true) {
            $.ajax({
                url: delete_url,
                type: 'DELETE',
                data: {
                  _token: "<?php echo csrf_token(); ?>"
                },
                success: function(result) {
                    // delete the row from the table
                    delete_button.parentsUntil('tr').parent().remove();
                    // Show an alert with the result
                    new PNotify({
                        title: "{{ trans('logmanager.delete_confirmation_title') }}",
                        text: "{{ trans('logmanager.delete_confirmation_message') }}",
                        type: "success"
                    });
                },
                error: function(result) {
                    // Show an alert with the result
                    new PNotify({
                        title: "{{ trans('logmanager.delete_error_title') }}",
                        text: "{{ trans('logmanager.delete_error_message') }}",
                        type: "warning"
                    });
                }
            });
        } else {
            new PNotify({
                title: "{{ trans('logmanager.delete_cancel_title') }}",
                text: "{{ trans('logmanager.delete_cancel_message') }}",
                type: "info"
            });
        }
      });
  });
</script>
@endsection
