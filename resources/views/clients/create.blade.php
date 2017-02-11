@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('client.create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firs_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">@lang('app.first_name')</label>

                            <div class="col-md-6">
                                <input id="first_name"
                                       type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="{{ old('first_name') }}"
                                       required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">@lang('app.last_name')</label>

                            <div class="col-md-6">
                                <input id="last_name"
                                       type="text"
                                       class="form-control"
                                       name="last_name"
                                       value="{{ old('last_name') }}"
                                       required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('2nd_last_name') ? ' has-error' : '' }}">
                            <label for="2nd_last_name" class="col-md-4 control-label">@lang('app.2nd_last_name')</label>

                            <div class="col-md-6">
                                <input id="2nd_last_name"
                                       type="text"
                                       class="form-control"
                                       name="2nd_last_name"
                                       value="{{ old('2nd_last_name') }}"
                                       required>

                                @if ($errors->has('2nd_last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('2nd_last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">@lang('app.phone')</label>

                            <div class="col-md-6">
                                <input id="phone"
                                       type="text"
                                       class="form-control"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">@lang('app.mobile')</label>

                            <div class="col-md-6">
                                <input id="mobile"
                                       type="text"
                                       class="form-control"
                                       name="mobile"
                                       value="{{ old('phone') }}"
                                       required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">@lang('app.address')</label>

                            <div class="col-md-6">
                                <input id="address"
                                       type="text"
                                       class="form-control"
                                       name="address"
                                       value="{{ old('phone') }}"
                                       required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">@lang('app.notes')</label>

                            <div class="col-md-6">
                                <textarea id="notes"
                                          class="form-control"
                                          name="notes"
                                          rows="5">{{ old('notes') }}</textarea>

                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
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
