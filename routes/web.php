<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// las rutas para los posts, con resource nos creara todas las necesarias para un crud con sus relaciones a tal metdo
Route::resource('posts', PostController::class);

// GET|HEAD        posts ....................................................... posts.index › PostController@index  
// POST            posts ....................................................... posts.store › PostController@store  
//   GET|HEAD        posts/create .............................................. posts.create › PostController@create  
//   GET|HEAD        posts/{post} .................................................. posts.show › PostController@show
//   PUT|PATCH       posts/{post} .............................................. posts.update › PostController@update  
//   DELETE          posts/{post} ............................................ posts.destroy › PostController@destroy  
//   GET|HEAD        posts/{post}/edit ............................................. posts.edit › PostController@edit  