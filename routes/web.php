<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('posts', function () {

    $response = Http::withHeaders([

        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        
    ])->post('http://api.codersfree.test/v1/posts', [
        'name' => 'Esto es una prueba de post',
        'slug' => 'esto-es-una-prueba-de-post',
        'extract' => 'sdsafsdfsd',
        'body' => 'asdasdasdasdasd',
        'category_id' => 1
    ]);

    return $response->json();

})->middleware('auth');