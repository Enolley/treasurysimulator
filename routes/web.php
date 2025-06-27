<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);
Route::get('/transfers', [TransferController::class, 'transfers']);
Route::get('/accounts', [MainController::class, 'accounts']);
Route::get('/transactions', [MainController::class, 'transactions']);
Route::post('/transfer', [TransferController::class, 'transfer'])->name('transfer');
Route::get('/export', [TransferController::class, 'export'])->name('export');

