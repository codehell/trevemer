@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('app.client.list')
                    <form class="form-inline" role="search" method="get" action="{{ route('client.index') }}">
                        <div class="form-group">
                            <label for="search" class="control-label">@lang('app.search')</label>

                                <input  id="search"
                                        type="text"
                                        class="form-control"
                                        name="search"
                                        value="{{ $search }}"
                                        autofocus>
                        </div>
                        <button type="submit" class="btn btn-default">@lang('app.search')</button>
                    </form>
                </div>

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
                                <th>@lang('app.email')</th>
                                <th>@lang('app.id_card')</th>
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
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->id_card }}</td>
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
