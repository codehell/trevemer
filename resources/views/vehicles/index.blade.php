@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.vehicle.list')</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('app.trademark')</th>
                                <th>@lang('app.model')</th>
                                <th>@lang('app.plate')</th>
                                <th>@lang('app.serial')</th>
                                <th>@lang('app.power')</th>
                                <th>@lang('app.displacement')</th>
                                <th>@lang('app.cams')</th>
                                <th>@lang('app.color')</th>
                                <th>@lang('app.doors')</th>
                                <th>@lang('app.kilometers')</th>
                                <th>@lang('app.vehicle.client_id')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr>
                                    <td><a href="{{ route('vehicle.show', $vehicle) }}">{{ $vehicle->id }}</a></td>
                                    <td>{{ $vehicle->trademark }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->plate }}</td>
                                    <td>{{ $vehicle->serial }}</td>
                                    <td>{{ $vehicle->power }}</td>
                                    <td>{{ $vehicle->displacement }}</td>
                                    <td>{{ $vehicle->cams }}</td>
                                    <td>{{ $vehicle->color }}</td>
                                    <td>{{ $vehicle->doors }}</td>
                                    <td>{{ $vehicle->kilometers }}</td>
                                    <td>{{ $vehicle->client->id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $vehicles->links() }}
        </div>
    </div>
</div>
@endsection