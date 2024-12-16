<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('over-ons', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('apply', function () {
    return view('apply');
});
