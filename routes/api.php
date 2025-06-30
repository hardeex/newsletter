<?php

// newsletter route:

use App\Http\Controllers\NewsLetterController;
use Illuminate\Support\Facades\Route;

Route::post('/subscribe', [NewsLetterController::class, 'subscribe'])->name('subscribe');