<?php

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

// 跟路由，对应的界面是resources/views/index.blade.php
// The interface corresponding to the route is resources/views/index.blade.php
Route::get('/', 'App\Http\Controllers\IndexController@index');

// 仪表盘界面路由，对应的界面是resources/views/dashboard.blade.php
// Instrument panel interface route, corresponding interface is resources/views/dashboard.blade.php
Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

// 退出登录的路由
// Exit logged in route
Route::get('/logout','App\Http\Controllers\DashboardController@logout')->middleware(['auth']);

// 仪表盘界面的子路由，有两个界面一个是添加新的预约 一个是 登记页面路由
// There are two sub routes in the dashboard interface, one is to add a new reservation, and the other is to register the page route
Route::prefix('dashboard')->namespace('App\Http\Controllers')->group(function () {
    Route::get('add_reservation', 'DashboardController@addReservation')->middleware(['auth']);
    Route::get('check_in', 'CheckInController@index')->middleware(['auth']);
});

// reservation下的三个请求路由，这三个路由是功能路由，是执行的对已预约的记录进行取消，以及在预约界面点击预约执行的操作 还有就是在登记页面点击登录后执行的请求功能
// The three request routes under reservation are function routes, which are used to cancel the reserved records, click the reservation in the reservation interface, and click login on the registration page
Route::prefix('reservation')->namespace('App\Http\Controllers')->group(function () {
        Route::get('cancel', 'ReservationController@cancel')->middleware(['auth']);
        Route::post('add', 'ReservationController@add')->middleware(['auth']);
        Route::post('checkin', 'ReservationController@checkIn')->middleware(['auth']);
});

require __DIR__.'/auth.php';
