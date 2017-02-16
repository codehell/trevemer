@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.client.list')</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('app.first_name')</th>
                                <th>@lang('app.last_name')</th>
                                <th>@lang('app.snd_last_name')</th>
                                <th>@lang('app.phone')</th>
                                <th>@lang('app.mobile')</th>
                            </tr>
                        </thead>
                        @foreach($clients as $client)
                            <tr>
                                <td><a href="#">{{ $client->id }}</a></td>
                                <td>{{ $client->first_name }}</td>
                                <td>{{ $client->last_name }}</td>
                                <td>{{ $client->snd_last_name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->mobile }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection
