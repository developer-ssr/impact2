<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
Route::get('/user', function (Request $request) {
    return $request->user();
    
})->middleware('auth:sanctum');



Route::get('/flask-data', function () {
    $response = Http::get('http://127.0.0.1:5000/');
    return $response->json();
});