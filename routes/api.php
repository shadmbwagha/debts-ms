<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\CustomerController;
use App\Http\controllers\CreditController;
use App\Http\controllers\DebtController;
use App\Http\controllers\AuthController;

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


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');


Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{customer}', [CustomerController::class, 'update']);
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
Route::get('/customerDebt/{debt}', [CustomerController::class, 'debt']);

Route::get('/debts', [DebtController::class, 'index']);
Route::get('/debts/{debt}', [DebtController::class, 'show']);
Route::post('/debts', [DebtController::class, 'store']);
Route::put('/debts/{debt}', [DebtController::class, 'update']);
Route::delete('/debts/{debt}', [DebtController::class, 'destroy']);

Route::get('/credit', [CreditController::class, 'index']);
Route::get('/credit/{credit}', [CreditController::class, 'show']);
Route::post('/credit', [CreditController::class, 'store']);
Route::put('/credit/{credit}', [CreditController::class, 'update']);
Route::delete('credit/{credit}', [CreditController::class, 'destroy']);

