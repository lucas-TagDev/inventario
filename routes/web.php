<?php
// ***********
// by lucas de freitas github: https://github.com/lucas-tagdev
// ***********
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Route::get('/', [WebController::class, 'index']);



Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('web', WebController::class);
    Route::get('/home', [App\Http\Controllers\WebController::class, 'index'])->name('home');
});

