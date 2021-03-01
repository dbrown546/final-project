@extends('layouts.app')

@section('content')
    <!-- This could have just as easily been delegated to a Vue component -->
    <div class="container">
        <div class="row">
            <div class="col-md">
                @foreach ($clients as $client)
                    <a href="/clients/{{$client->id}}/funds">{{ $client->name }}</a><br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
