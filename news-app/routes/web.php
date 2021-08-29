<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [NewsController::class, 'home']); // Главная страница
Route::post('/search', [NewsController::class, 'search']); // Страница поиска
Route::get('/news', [NewsController::class, 'news']);
Route::get('/news/{id}', [NewsController::class, 'newsDetail']);
Route::post('/addToChosen', [NewsController::class, 'addToChosen']);
