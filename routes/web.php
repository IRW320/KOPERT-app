<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/logout-sidebar', function () {
    $user = Auth::user();
    Auth::logout();
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    if ($user && $user->role !== 'admin') {
        return redirect('/admin/register');
    }
    return redirect('/admin/login');
})->name('admin.logout.sidebar');
