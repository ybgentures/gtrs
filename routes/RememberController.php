<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/tujuh', function () {
    return view('pages.remember.tujuh');
});
Route::get('/delapan', function () {
    return view('pages.remember.delapan');
});
Route::get('/sembilan', function () {
    return view('pages.remember.sembilan');
});
Route::get('/sepuluh', function () {
    return view('pages.remember.sepuluh');
});
Route::get('/sebelas', function () {
    return view('pages.remember.sebelas');
});
Route::get('/duabelas', function () {
    return view('pages.remember.duabelas');
});