<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () { return view('home'); })->name('home');
Route::get('/servicios', function () { return view('servicios'); })->name('servicios');
Route::get('/proyectos', function () { return view('proyectos'); })->name('proyectos');
Route::get('/blog', function () { return view('blog'); })->name('blog');
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');

Route::resource('clientes', ClienteController::class);
