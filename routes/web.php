<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
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



Auth::routes();

Route::middleware('auth')->group(function(){
    Route::resource('event', EventController::class);
    Route::get('/', [EventController::class, 'index']);
    Route::get('event', [EventController::class, 'index'])->name('event.index');

    // Channel
    Route::get('event/{event}/channel', [ChannelController::class, 'create'])->name('channel.create');
    Route::post('event/{event}/channel', [ChannelController::class, 'store'])->name('channel.store');

    // Ticket
    Route::get('event/{event}/ticket', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('event/{event}/ticket', [TicketController::class, 'store'])->name('ticket.store');

    // Room
    Route::get('event/{event}/room', [RoomController::class, 'create'])->name('room.create');
    Route::post('event/{event}/room', [RoomController::class, 'store'])->name('room.store');

    // Session
    Route::get('event/{event}/session', [SessionController::class, 'create'])->name('session.create');
    Route::post('event/{event}/session', [SessionController::class, 'store'])->name('session.store');
    Route::get('event/{event}/channel/{channel}', [SessionController::class, 'edit'])->name('session.edit');
    Route::put('event/{event}/channel/{channel}', [SessionController::class, 'update'])->name('session.update');
});