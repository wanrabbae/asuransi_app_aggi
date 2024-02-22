<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("address")->group(function () {
    Route::get("provinces", "App\Http\Controllers\AddressController@provinces");
    Route::get("regencies/{province_id}", "App\Http\Controllers\AddressController@regencies");
    Route::get("districts/{regency_id}", "App\Http\Controllers\AddressController@districts");
    Route::get("postcode/{kota}", "App\Http\Controllers\AddressController@postcode");
});

Route::get('/chart-graph-income', [AdminController::class, 'chartGraphIncome'])->name('chart-graph-income');
Route::get('/chart-graph-polis', [AdminController::class, 'chartGraphPolis'])->name('chart-graph-polis');
Route::get('/chart-graph-finance', [AdminController::class, 'chartGraphFinance'])->name('chart-graph-finance');

Route::post('/ipaymu/callback', [TransactionController::class, 'callBackPayment']);
Route::get('/notification', [NotificationController::class, 'index'])->name('index.notif');
