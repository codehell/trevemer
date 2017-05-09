@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-1"> {{ $client->id }}</div>
                        <div class="col-md-6">
                            {{ $client->first_name .' '. $client->last_name .' '. $client->snd_last_name }}
                        </div>
                        <div class="col-md-2 col-md-offset-3"> {{ $client->id_card }}</div>
                    </div>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>@lang('app.id_card'): {{ $client->id_card }}</li>
                        <li>@lang('app.phones'):
                            <ul>
                                @foreach($client->phones as $phone)
                                    <div class="row">
                                        <li>
                                            <div class="col-md-4">{{ $phone->number }}</div>
                                            <div class="col-md-1">
                                                <form method="post" action="{{ route('phone.delete', $phone) }}">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm">-</button>
                                                </form>
                                            </div>
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        </li>
                        <li>@lang('app.address'): {{ $client->address }} - {{ $client->postal_code }}</li>
                        <li>@lang('app.email'): {{ $client->email }}</li>
                        <li>@lang('app.vehicle_plate'):
                            <ul>
                                @foreach($client->vehicles as $vehicle)
                                    <li>{{ $vehicle->plate }}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li>@lang('app.note'): {{ $client->note }}</li>
                    </ul>
                    <div class="row">
                        <div class="col-md-2">
                            <form method="get" action="{{ route('vehicle.create') }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="btn btn-primary" type="submit">@lang('app.vehicle.create')</button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-primary" href="{{ route('client.edit', $client) }}">@lang('app.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection