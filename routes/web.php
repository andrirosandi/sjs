<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Modules\Seal;

Route::get('/', Dashboard::class)->middleware(AuthMiddleware::class);
Route::get('/seal', Seal::class)->middleware(AuthMiddleware::class);

Route::get('/auth/login', Login::class);
Route::get('/auth/logout', Logout::class);
// Route::get('/', Dashboard::class)->middleware(authMiddleware::class);