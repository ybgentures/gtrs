<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/one', function () {
    return view('pages.news.one');
});
Route::get('/two', function () {
    return view('pages.news.two');
});
Route::get('/three', function () {
    return view('pages.news.three');
});