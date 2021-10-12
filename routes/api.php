<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\ProfileUserController;
use App\Http\Controllers\API\RegisteredUserController;
use App\Http\Controllers\API\EmailVerificationController;
use App\Http\Controllers\API\SmsVerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


      
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisteredUserController::class, 'store']);


Route::post('email/verification-by-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:api');
Route::get('verify-by-email/{id}/{hash}', [EmailVerificationController::class, 'verifyMail'])->name('verification.verifyByMail')->middleware('auth:api');

Route::post('sms/verification', [SmsVerificationController::class, 'sms'])->middleware('auth:api');


Route::apiResource('article', ArticleController::class);
Route::apiResource('profile', ProfileUserController::class);
     
