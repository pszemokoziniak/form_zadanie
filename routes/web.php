<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController; 


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

Route::get('/add_client', [ClientController::class, 'index']);
Route::post('/save',[ClientController::class, 'save'])->name('client.save');
Route::get('/add_desc_client/{id}', [ClientController::class, 'desc'])->name('clients.desc');
Route::post('/save_desc',[ClientController::class, 'save_desc'])->name('client.save_desc');



