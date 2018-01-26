@extends('app')

@section('content')


    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1>Edit Restaurant</h1>
                @include('errors.errors')
            </div>
        </div>
        <form action="/restaurant/edit" method="POST" class="form-horizontal">
        {{ csrf_field() }}

            <div class="form-group">
                <label for="restaurant" class="col-sm-3 control-label">Name</label>
                <input type="text" name="id" id="restaurant-id" class="form-control hidden" value="{{$restaurant->id}}">

                <div class="col-sm-6">
                    <input type="text" name="name" id="restaurant-name" class="form-control" placeholder="{{$restaurant->name}}" value="{{$restaurant->name}}">
                </div>

            </div>
            <div class="form-group">
                <label for="restaurant" class="col-sm-3 control-label">Location</label>

                <div class="col-sm-6">
                    <input type="text" name="location" id="restaurant-location" class="form-control" placeholder="{{$restaurant->location}}" value="{{$restaurant->location}}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Edit Restaurant
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection