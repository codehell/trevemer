@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.vehicle.create_title')</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('trademark') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.trademark')</label>
                        </div>
                        <div class="form-group{{ $errors->has('model') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.model')</label>
                        </div>
                        <div class="form-group{{ $errors->has('plate') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.plate')</label>
                        </div>
                        <div class="form-group{{ $errors->has('serial') }}">
                        <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.serial')</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection