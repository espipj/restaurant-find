@extends('app')

@section('content')



    <div class="panel-body">

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                @include('errors.errors')
            </div>
        </div>
        <form action="/restaurant" method="POST" class="form-horizontal">
        {{ csrf_field() }}

            <div class="form-group">
                <label for="restaurant" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="restaurant-name" class="form-control">
                </div>

            </div>
            <div class="form-group">
                <label for="restaurant" class="col-sm-3 control-label">Location</label>

                <div class="col-sm-6">
                    <input type="text" name="location" id="restaurant-location" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Restaurant
                    </button>
                </div>
            </div>
        </form>
    </div>


    @if (count($restaurants) > 0)
        <div class="panel panel-default col-sm-offset-3 col-sm-6">
            <div class="panel-heading">
                Registered Restaurants
            </div>

            <div class="panel-body">
                <table class="table table-striped restaurant-table">

                    <thead>
                    <th>Restaurant</th>
                    <th>Location</th>
                    <th>&nbsp;</th>
                    </thead>

                    <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td class="table-text">
                                <div>{{ $restaurant->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $restaurant->location }}</div>
                            </td>

                            <td>
                                <form action="/restaurant/view/{{ $restaurant->id }}" method="GET">
                                    {{ csrf_field() }}

                                    <button>View Restaurant</button>
                                </form>
                            </td>
                            <td>
                                <form action="/restaurant/edit/{{ $restaurant->id }}" method="GET">
                                    {{ csrf_field() }}

                                    <button>Edit Restaurant</button>
                                </form>
                            </td>
                            <td>
                                <form action="/restaurant/{{ $restaurant->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Delete Restaurant</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection