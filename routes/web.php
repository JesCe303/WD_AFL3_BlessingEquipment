<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.homepage');
});

Route::get('/about', function () {
    return view('pages.about', [
        'name' => 'William',
        'age' => 19,
        'alamat' => 'Surabaya'
    ]);
});


Route::view('/contact', 'pages.contact');

// one contoller can be used for many routes or methods
Route::get('/product', [ProductController::class, 'index']); //read data show data

Route::get('/product/create', [ProductController::class, 'create']); //show page : form data
Route::post('/product', [ProductController::class, 'store']); //store data to database from form page
Route::get('/product/{id}', [ProductController::class, 'show']); //show page : detail data

Route::get('/product/{id}/edit', [ProductController::class, 'edit']); //show page : edit form data
Route::put('/product/{id}', [ProductController::class, 'update']); //update data to database

Route::delete('/product/{id}', [ProductController::class, 'destroy']); //delete data from database

