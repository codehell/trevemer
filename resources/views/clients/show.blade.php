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
                        <li>@lang('app.mobile'): {{ $client->mobile }}</li>
                        <li>@lang('app.phones'): {{ $client->phones }}</li>
                        <li>@lang('app.address'): {{ $client->address }} - {{ $client->postal_code }}</li>
                        <li>@lang('app.email'): {{ $client->email }}</li>
                        <li>@lang('app.car_plate'): {{ $client->car_plate }}</li>
                        <li>@lang('app.note'): {{ $client->note }}</li>
                    </ul>
                    <form method="get" action="{{ route('vehicle.create') }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <button type="submit">@lang('app.vehicle.create')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection