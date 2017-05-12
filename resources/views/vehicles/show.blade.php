@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-1">{{ $vehicle->id }}</div>
                            <div class="col-md-5">{{ $vehicle->trademark . ' - ' . $vehicle->model }}</div>
                            <div class="col-md-3">{{ $vehicle->plate }}</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>@lang('app.client.id')</dt>
                            <dd>{{ $vehicle->client->id }}</dd>
                            <dt>@lang('app.client.name')</dt>
                            <dd>{{ $vehicle->client->first_name . ' ' . $vehicle->client->last_name}}</dd>
                            <dt>@lang('app.vehicle.plate')</dt>
                            <dd>{{ $vehicle->plate }}</dd>
                            <dt>@lang('app.vehicle.serial')</dt>
                            <dd>{{ $vehicle->serial }}</dd>
                            <dt>@lang('app.vehicle.power')</dt>
                            <dd>{{ $vehicle->power }}</dd>
                            <dt>@lang('app.vehicle.displacement')</dt>
                            <dd>{{ $vehicle->displacement }}</dd>
                            <dt>@lang('app.vehicle.cams')</dt>
                            <dd>{{ $vehicle->cams }}</dd>
                            <dt>@lang('app.color')</dt>
                            <dd>{{ $vehicle->color }}</dd>
                            <dt>@lang('app.doors')</dt>
                            <dd>{{ $vehicle->doors }}</dd>
                            <dt>@lang('app.kilometers')</dt>
                            <dd>{{ $vehicle->kilometers }}</dd>
                        </dl>
                        <a class="btn btn-primary" href="{{ route('vehicle.edit', $vehicle) }}">@lang('app.update')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection