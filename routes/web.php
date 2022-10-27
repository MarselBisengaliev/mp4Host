<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VideoController;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    $videos = Video::all();
    return view('home', compact('videos'));
})->name('home');

Route::get('/account/{accountId}', function(int $accountId) {
    $user = User::query()->where('id', $accountId)->firstOrFail();
    return view('account.index', compact('user'));
})->middleware('auth')->name('account');

Route::post('/update-password', [AccountController::class, 'updatePassowrd'])->name('update-password');

Route::get('/admin', function() {
    $videos = Video::all();
    return view('admin.admin', compact('videos'));
})->middleware(['auth', 'is-admin'])->name('admin');

Route::get('/my-video', function() {
    $videos = Video::query()->where('user_id', Auth::id())->get();
    return view('video.my-video', compact('videos'));
})->middleware('auth')->name('video.my-video');

Route::get('create-video', function() {
    return view('video.create');
})->middleware('auth')->name('video.create');

Route::post('store-video', [VideoController::class, 'store'])
    ->middleware('auth')
    ->name('video.store');

Route::post('/update-video/{videoId}', [VideoController::class, 'update'])
    ->middleware(['auth', 'is-admin'])
    ->name('video.update');

Route::get('/one-video/{videoId}', function(int $videoId) {
    $video = Video::query()->where('id', $videoId)->firstOrFail();
    return view('video.one-video', compact('video'));
})->name('video.one-video');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/registration', [AuthController::class, 'registration'])->name('auth.registration');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/authorization', [AuthController::class, 'authorization'])->name('auth.authorization');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/email/verify', function() {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verifify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('video.my-video');
})->middleware(['signed', 'auth'])->name('verification.verify');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with(
        'message',
        'Ссылка для подтверждения отправлена!'
    );
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/store-comment/{videoId}', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comment.store');
