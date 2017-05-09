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
                        <ul>
                            <li>@lang('app.client.id'): {{ $vehicle->client->id }}</li>
                            <li>@lang('app.client.name'): {{ $vehicle->client->first_name . ' ' . $vehicle->client->last_name}}</li>
                            <li>@lang('app.vehicle.serial'): {{ $vehicle->serial }}</li>
                            <li>@lang('app.vehicle.power'): {{ $vehicle->power }}</li>
                            <li>@lang('app.vehicle.displacement'): {{ $vehicle->displacement }}</li>
                            <li>@lang('app.vehicle.cams'): {{ $vehicle->cams }}</li>
                            <li>@lang('app.color'): {{ $vehicle->color }}</li>
                            <li>@lang('app.doors'): {{ $vehicle->doors }}</li>
                            <li>@lang('app.kilometers'): {{ $vehicle->kilometers }}</li>
                        </ul>
                        <a class="btn btn-primary" href="{{ route('vehicle.edit', $vehicle) }}">@lang('app.update')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection