<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Modules\Seal;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Admin\Modules\Passwordchange;
use App\Livewire\Admin\Modules\Sealreport;

Route::get('/', Dashboard::class)->middleware(AuthMiddleware::class);
Route::get('/seal', Seal::class)->middleware(AuthMiddleware::class)->name('segel');
Route::get('/sealreport', Sealreport::class)->middleware(AuthMiddleware::class)->name('segelreport');
Route::get('/changepassword', Passwordchange::class)->middleware(AuthMiddleware::class)->name('changepassword');

Route::get('/auth/login', Login::class);
Route::get('/auth/logout', Logout::class);

Route::get('/landingpage',function () {
    return view('landingpage');
});
// Route::get('/', Dashboard::class)->middleware(authMiddleware::class);

Route::get('/time', function () {
    // Mendapatkan timezone saat ini
    // $timezone = config('app.timezone');
    
    // // Mendapatkan tanggal dan waktu saat ini
    // $dateTime = now()->format('Y-m-d H:i:s');

    return response()->json([
        'server_timezone' => date_default_timezone_get(),
        'app_timezone' => config('app.timezone'),
        'current_time' => now()->format('Y-m-d H:i:s'),
        
    ]);
});