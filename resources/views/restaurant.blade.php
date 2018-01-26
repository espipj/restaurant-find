@extends('app')

@section('content')


    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1>Restaurant Detail</h1>
            </div>
        </div>

        <div class="panel-info col-sm-6 col-sm-offset-3">
            <h3>Name: {{$restaurant->name}}</h3>
            <h3>Location: {{$restaurant->location}}</h3>

        </div>
    </div>


@endsection