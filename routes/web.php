<?php

use App\Http\Controllers\Payment\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// payment.status
Route::get('/notication/payment', [NotificationController::class, 'notificationPaymentStatus'])->name('payment.status');
