@extends('layouts.app')

@section('content')
    <!-- This could have just as easily been delegated to a Vue component, I just figured I'd show off some versatility -->
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h1>{{ $client->name }}</h1>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Fund Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Inception Date</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $permission = json_decode($client->permission);
                    @endphp
                    @foreach ($funds as $fund)
                        <tr>
                            <td>{{ in_array($fund->type, $permission) ? $fund->name : '***'}}</td>
                            <td>{{ $fund->type }}</td>
                            <td>{{ in_array($fund->type, $permission) ? $fund->inception_date->toDateString() : '*********'}}</td>
                            <td>{{ in_array($fund->type, $permission) ? $fund->description : '************'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
