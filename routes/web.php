<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = request()->user();
    return view('welcome', ['clients' => $user->clients, 'jobs' => $user->jobs]);
});

Route::get('/api/appoint', function () {
    $user = request()->user();
    $dateStart = request()->input('month');


    // Convert the start date to a Carbon instance
    $dateStart = \Carbon\Carbon::parse($dateStart)->next('month');

    // Calculate the start and end dates for the current, next, and previous months
    $start = $dateStart->copy()->startOfMonth();
    $end = $dateStart->copy()->endOfMonth();
    return $user->appointments()->whereBetween('date', [$start, $end])->get();
});
Route::resource('/jobs', JobController::class)->except('show')->middleware('auth');
Route::resource('/clients', ClientController::class)->except('show')->middleware('auth');
Route::resource('/appointments', AppointmentController::class)->except('show')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
