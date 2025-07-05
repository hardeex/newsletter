<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\SendMailController;
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



// authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/resend-verification-code', [AuthController::class, 'resendVerificationEmail']);
Route::post('/password-confirm', [AuthController::class, 'passwordConfirm']);
Route::post('/password-reset-request', [AuthController::class, 'sendPasswordResetEmail']);
Route::post('/password-reset', [AuthController::class, 'resetPassword']);
Route::get('/logged-in-user', [AuthController::class, 'checkUser']);



Route::middleware('auth')->group(function () {
    // authentication routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);


});




// TODO: Test the email sending routes below
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bulk-email/send', [SendMailController::class, 'send']);
    Route::get('/bulk-email/status/{batchId}', [SendMailController::class, 'getBatchStatus']);
    Route::get('/bulk-email/lists', [SendMailController::class, 'getEmailLists']);
});