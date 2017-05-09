@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('app.client.edit_title') - Id: {{ $client->id }}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('client.edit', $client) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('firs_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">@lang('app.first_name')</label>

                            <div class="col-md-6">
                                <input id="first_name"
                                       type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="{{ old('first_name', $client->first_name) }}"
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
                                       value="{{ old('last_name', $client->last_name) }}"
                                       required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('snd_last_name') ? ' has-error' : '' }}">
                            <label for="snd_last_name" class="col-md-4 control-label">@lang('app.snd_last_name')</label>

                            <div class="col-md-6">
                                <input id="snd_last_name"
                                       type="text"
                                       class="form-control"
                                       name="snd_last_name"
                                       value="{{ old('snd_last_name', $client->snd_last_name) }}">

                                @if ($errors->has('snd_last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('snd_last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id_card') ? ' has-error' : '' }}">
                            <label for="id_card" class="col-md-4 control-label">@lang('app.id_card')</label>

                            <div class="col-md-6">
                                <input id="id_card"
                                       type="text"
                                       class="form-control"
                                       name="id_card"
                                       value="{{ old('id_card', $client->id_card) }}">

                                @if ($errors->has('id_card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phones" class="col-md-4 control-label">@lang('app.phone')</label>

                            <div class="col-md-6">
                                <input id="phones"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('phones', $client->phones->isEmpty() ? '' : $client->phones->last()->number) }}"
                                disabled>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">@lang('app.address')</label>

                            <div class="col-md-6">
                                <input id="address"
                                       type="text"
                                       class="form-control"
                                       name="address"
                                       value="{{ old('address', $client->address) }}"
                                       required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <label for="postal_code" class="col-md-4 control-label">@lang('app.postal_code')</label>

                            <div class="col-md-6">
                                <input id="address"
                                       type="text"
                                       class="form-control"
                                       name="postal_code"
                                       value="{{ old('postal_code', $client->postal_code) }}"
                                       required>

                                @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('app.email')</label>

                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email', $client->email) }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">@lang('app.note')</label>

                            <div class="col-md-6">
                                <textarea id="note"
                                          class="form-control"
                                          name="note"
                                          rows="5">{{ old('note', $client->note) }}</textarea>

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('app.update')
                                </button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" role="form" method="post" action="{{ route('phone.create', $client) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">@lang('app.client.new_phone')</label>

                            <div class="col-md-6">
                                <input id="phone"
                                       class="form-control"
                                       name="phone"
                                       rows="5"
                                       value = "{{ old('phone') }}"
                                >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('app.add')
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
