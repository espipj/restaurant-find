<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Restaurant;
use Illuminate\Http\Request;

Route::get('/', function () {
    $restaurants = Restaurant::orderBy('created_at', 'asc')->get();

    return view('restaurants', [
        'restaurants' => $restaurants
    ]);
});

Route::post('/restaurant', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'location' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $restaurant = new Restaurant;
    $restaurant->name = $request->name;
    $restaurant->location = $request->location;
    $restaurant->save();

    return redirect('/');

});

Route::get('/restaurant/edit/{id}', function ($id) {

    $restaurant = Restaurant::findOrFail($id);

    return view('restaurantsedit',compact('restaurant'));

});


Route::post('/restaurant/edit', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'id' => 'required',
        'location' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
    }

    $restaurant = Restaurant::findOrFail($request->id);
    $restaurant->name = $request->name;
    $restaurant->location = $request->location;
    $restaurant->save();

    return redirect('/');

});

Route::get('/restaurant/view/{id}', function ($id) {

    $restaurant = Restaurant::findOrFail($id);

    return view('restaurant',compact('restaurant'));

});

Route::delete('/restaurant/{id}', function ($id) {
    Restaurant::findOrFail($id)->delete();

    return redirect('/');
});


Route::get('/find', function () {
    $restaurants=Restaurant::all();
    return view('find', compact('restaurants'));

});



Route::post('/find', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'location' => 'required',
        'idclosest' => 'required',
        'duration' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
    }

    $restaurant=Restaurant::findOrFail($request->idclosest);
    $location=$request->location;
    $duration=$request->duration;
    return view('result', compact('restaurant','location','duration'));

});

