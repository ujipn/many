<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TalkController;
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
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [WelcomeController::class, 'index'])->name('home');
// Route::get('/detail/{id}', [WelcomeController::class, 'detail'])->name('detail');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
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
Route::get('/assets/{asset}', [AssetController::class, 'show'])->name('assets.show')->middleware('auth');
Route::resource('orders', OrderController::class)->middleware('auth');


//カレンダー機能
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/calendar/create/{asset_id}', [CalendarController::class, 'create'])->name('calendars.create');
Route::get('/calendar/edit/{asset_id}/{calendar_id}', [CalendarController::class, 'edit'])->name('calendars.edit');
Route::put('/calendar/update/{asset_id}/{calendar_id}', [CalendarController::class, 'update'])->name('calendars.update');
Route::get('/calendar/show/{calendar_id}', [CalendarController::class, 'show'])->name('calendars.show');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendars.store');
Route::delete('/calendar/{calendar}', [CalendarController::class, 'destroy'])->name('calendars.destroy');

//アセットIDをパラメータとして受け取るように設定
Route::get('get_events/{asset_id}', [CalendarController::class, 'getEvents']);

//取引機能
Route::get('transaction/{calendar_id}', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('transaction/{calendar_id}', [TransactionController::class, 'store'])->name('transaction.store');
Route::post('transaction/{calendar_id}', [TransactionController::class, 'store'])
    ->name('transaction.store')
    ->middleware('auth');

//取引後のコメントやり取り
Route::post('post/{transaction_id}', [PostController::class, 'store'])->name('post.store');
Route::get('posts/{transaction_id}', [PostController::class, 'index'])->name('posts.index');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//取引後のコメントやり取り
Route::post('orders/{order}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::put('/orders/{order}/details', [OrderController::class, 'updateDetails'])->name('orders.updateDetails');

Route::post('assets/{asset}/talks', [TalkController::class, 'store'])->name('talks.store');
Route::delete('talks/{talk}', [TalkController::class, 'destroy'])->name('talks.destroy');


require __DIR__ . '/auth.php';
