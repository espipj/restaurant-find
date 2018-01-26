@extends('app')

@section('content')
<div class="panel-body">
    <div class="col-sm-6 col-sm-offset-3">
    <form action="/find" method="POST" class="form-horizontal">
    {{ csrf_field() }}

        <div class="form-group">
            <label class="col-sm-3 control-label">Your location</label>

            <div class="col-sm-6">
                <input type="text" name="location" id="location" class="form-control">
            </div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Find closest
                </button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection