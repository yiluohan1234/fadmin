@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('base.login') }}</div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('fadmin.auth.login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has($username) ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ config('fadmin.base.authentication_column_name') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="{{ $username }}" value="{{ old($username) }}">

                                @if ($errors->has($username))
                                    <span class="help-block">
                                        <strong>{{ $errors->first($username) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('base.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('base.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('base.login') }}
                                </button>

                                @if (fadmin_users_have_email())
                                <a class="btn btn-link" href="{{ route('fadmin.auth.password.reset') }}">{{ trans('base.forgot_your_password') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
