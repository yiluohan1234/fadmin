@extends('layouts.layout')

@section('header')
  <section class="content-header">
    <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
        <small>{{ trans('crud.revisions') }}.</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(config('fadmin.base.route_prefix'),'dashboard') }}">{{ config('fadmin.base.project_name') }}</a></li>
      <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
      <li class="active">{{ trans('crud.revisions') }}</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <!-- Default box -->
    @if ($crud->hasAccess('list'))
      <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
    @endif

    @if(!count($revisions))
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('crud.no_revisions') }}</h3>
        </div>
      </div>
    @else
      @include('crud.inc.revision_timeline')
    @endif
  </div>
</div>
@endsection


@section('after_styles')
  <link rel="stylesheet" href="/fadmin/crud/css/crud.css">
  <link rel="stylesheet" href="/fadmin/crud/css/revisions.css">
@endsection

@section('after_scripts')
  <script src="/fadmin/crud/js/crud.js"></script>
  <script src="/fadmin/crud/js/revisions.js"></script>
@endsection
