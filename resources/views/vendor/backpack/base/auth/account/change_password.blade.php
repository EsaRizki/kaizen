@extends('backpack::layout')

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
        {{ trans('backpack::base.my_account') }}
    </h1>

    <ol class="breadcrumb">

        <li>
            <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
        </li>

        <li>
            <a href="{{ route('backpack.account.info') }}">{{ trans('backpack::base.my_account') }}</a>
        </li>

        <li class="active">
            {{ trans('Ganti Password') }}
        </li>

    </ol>

</section>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        @include('backpack::auth.account.sidemenu')
    </div>
    <div class="col-md-6">

        <form class="form" action="{{ route('backpack.account.password') }}" method="post">

            {!! csrf_field() !!}

            <div class="box padding-10">

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
                            $label = trans('Password Lama');
                            $field = 'old_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                    <div class="form-group">
                        @php
                            $label = trans('Password Baru');
                            $field = 'new_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                    <div class="form-group">
                        @php
                            $label = trans('Konfirmasi Password');
                            $field = 'confirm_password';
                        @endphp
                        <label class="required">{{ $label }}</label>
                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="" placeholder="{{ $label }}">
                    </div>

                    <div class="form-group m-b-0">

                        <button type="submit" class="btn btn-success"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('Simpan') }}</span></button>
                        <a href="{{ backpack_url() }}" class="btn btn-default"><span class="ladda-label">{{ trans('Batal') }}</span></a>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
@endsection
