@extends('layouts.layout')
@section('header')
    <section class="content-header">
      <h1>
        {{ trans('base.dashboard') }}<small>{{ trans('base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ fadmin_url() }}">{{ config('fadmin.base.project_name') }}</a></li>
        <li class="active">{{ trans('base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('base.logged_in') }}</div>
            </div>
        </div>
    </div>
    @if(count($timeline) != 0)
    <div class="box">
        <div class="box-body">
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              @foreach($timeline as $t)
                @foreach($t as $key => $value)
                  <li class="time-label">
                        <span class="bg-blue">
                          {{$key}}
                        </span>
                  </li>

                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  @foreach($value as $v)
                  <li>
                    <i class="fa {{$v->action}} {{$v->color}}"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> {{$v->date}}</span>

                      <h3 class="timeline-header">{{$v->title}}</h3>

                      <div class="timeline-body">
                        {!!$v->content!!}
                      </div>
                      <!-- <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div> -->
                    </div>
                  </li>
                  @endforeach
                @endforeach
              @endforeach
              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
        </div>
    </div>
    @endif
@endsection
