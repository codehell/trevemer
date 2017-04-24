@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.vehicle.create_title')</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('vehicle.create') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('trademark') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.trademark')</label>
                            <div class="col-md-6">
                                <input id="trademark"
                                       type="text"
                                       class="form-control"
                                       name="trademark"
                                       value="{{ old('trademark') }}"
                                       required autofocus>
                                @if ($errors->has('trademark'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('trademark') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('model') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.model')</label>
                            <div class="col-md-6">
                                <input id="model"
                                       type="text"
                                       class="form-control"
                                       name="model"
                                       value="{{ old('model') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('plate') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.plate')</label>
                            <div class="col-md-6">
                                <input id="plate"
                                       type="text"
                                       class="form-control"
                                       name="plate"
                                       value="{{ old('plate') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('serial') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.serial')</label>
                            <div class="col-md-6">
                                <input id="serial"
                                       type="text"
                                       class="form-control"
                                       name="serial"
                                       value="{{ old('serial') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('power') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.power')</label>
                            <div class="col-md-6">
                                <input id="power"
                                       type="text"
                                       class="form-control"
                                       name="power"
                                       value="{{ old('power') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('displacement') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.displacement')</label>
                            <div class="col-md-6">
                                <input id="displacement"
                                       type="text"
                                       class="form-control"
                                       name="displacement"
                                       value="{{ old('displacement') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cams') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.cams')</label>
                            <div class="col-md-6">
                                <input id="cams"
                                       type="text"
                                       class="form-control"
                                       name="cams"
                                       value="{{ old('cams') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('color') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.color')</label>
                            <div class="col-md-6">
                                <input id="color"
                                       type="text"
                                       class="form-control"
                                       name="color"
                                       value="{{ old('color') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('doors') }}">
                            <label for="trademark" class="col-md-4 control-label">@lang('app.vehicle.doors')</label>
                            <div class="col-md-6">
                                <input id="doors"
                                       type="text"
                                       class="form-control"
                                       name="doors"
                                       value="{{ old('doors') }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('app.register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
