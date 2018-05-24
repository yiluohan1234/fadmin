@extends('layouts.layout')

@section('after_styles')
<style media="screen">
    .backpack-profile-form .required::after {
        content: ' *';
        color: red;
    }
</style>
@endsection

@section('header')
<section class="content-header">

    <h1>
        {{ trans('base.my_account') }}
    </h1>

    <ol class="breadcrumb">

        <li>
            <a href="{{ fadmin_url() }}">{{ config('base.project_name') }}</a>
        </li>

        <li>
            <a href="{{ route('fadmin.account.info') }}">{{ trans('base.my_account') }}</a>
        </li>

        <li class="active">
            {{ trans('base.change_password') }}
        </li>

    </ol>

</section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('fadmin.account.sidemenu')
    </div>
    <div class="col-md-6">

        <form class="form" action="{{ route('fadmin.account.password') }}" method="post">

            {!! csrf_field() !!}

            <div class="box">

                <div class="box-body backpack-profile-form">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->count())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        @php
                            $label = trans('base.old_password');
                            $field = 'old_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                    <div class="form-group">
                        @php
                            $label = trans('base.new_password');
                            $field = 'new_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                    <div class="form-group">
                        @php
                            $label = trans('base.confirm_password');
                            $field = 'confirm_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                </div>

                <div class="box-footer">

                    <button type="submit" class="btn btn-success"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('base.change_password') }}</span></button>
                    <a href="{{ fadmin_url() }}" class="btn btn-default"><span class="ladda-label">{{ trans('base.cancel') }}</span></a>

                </div>
            </div>

        </form>

    </div>
</div>
@endsection
