<?php


use App\Http\Controllers\NewsLetterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;


// Route::get('/debug-config', function () {
//     return [
//         'recaptcha_secret' => config('services.recaptcha.secret'),
//         'recaptcha_site_key' => config('services.recaptcha.site_key') ? '****' : null,      
//     ];
// });


Route::post('/subscribe', [NewsLetterController::class, 'subscribe'])
    ->name('subscribe')
    ->middleware('custom_throttle:2,1'); // 2 requests per minute per user

Route::get('/unsubscribe/{token}', [NewsLetterController::class, 'unsubscribe'])
    ->name('unsubscribe');