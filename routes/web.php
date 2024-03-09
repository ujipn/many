<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// トップページや一般ユーザーなどすべてのユーザー向けのページ
Route::get('/', function () {
        return view('welcome');
})->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
// Route::get('/detail/{id}', [WelcomeController::class, 'detail'])->name('detail');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// 管理者専用のルート
Route::middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('assets', AssetController::class)->except('show');
});

// 一般ユーザーがアクセス可能なアセット表示ルート
Route::get('/assets/{asset}', [AssetController::class, 'show'])->name('assets.show');

//カレンダー機能
Route::get('/calendar', [CalendarController::class,'index'])->name('calendar');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendars.store');
    //アセットIDをパラメータとして受け取るように設定
Route::get('get_events/{asset_id}', [CalendarController::class, 'getEvents']);

require __DIR__ . '/auth.php';
