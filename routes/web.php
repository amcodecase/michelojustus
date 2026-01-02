<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data = require resource_path('data/profile.php');
    return view('home', compact('data'));
});
