<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function() {
    return Auth::user();
})->name('user');

// トークンリフレッシュ
Route::get('/reflesh-token', function (Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/photos', 'PhotoController@create')->name('photo.create');
Route::get('/photos', 'PhotoController@index')->name('photo.index');
Route::get('/photos/{id}', 'PhotoController@show')->name('photo.show');
Route::post('/photos/{photo}/comments', 'PhotoController@addComment')->name('photo.comment');
Route::put('/photos/{id}/like', 'PhotoController@like')->name('photo.like');
Route::delete('/photos/{id}/like', 'PhotoController@unlike');