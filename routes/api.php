<?php

use App\Http\Controllers\WaitlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public waitlist endpoints
Route::post('/waitlist', [WaitlistController::class, 'store'])
    ->middleware('throttle:10,1'); // 10 requests per minute

Route::get('/waitlist/{referralCode}/stats', [WaitlistController::class, 'show']);

Route::get('/waitlist/count', [WaitlistController::class, 'count'])
    ->middleware('throttle:10,1'); // 10 requests per minute

// Admin endpoints (you may want to add authentication middleware later)
Route::prefix('admin')->group(function () {
    Route::get('/waitlist', [WaitlistController::class, 'index']);
});
