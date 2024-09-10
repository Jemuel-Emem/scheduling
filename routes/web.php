<?php
use App\Http\Controllers\AuthController;
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

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin-dashboard');
           }
           if (auth()->user()->is_admin == 0) {
            return redirect()->route('user-dashboard');
           }

         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){

        Route::get('/admin', function(){
            return view('admin.index');
        })->name('admin-dashboard');

        Route::get('/Medicine', function(){
            return view('admin.medicine');
        })->name('med');

        Route::get('/Appointments', function(){
            return view('admin.appointments');
        })->name('apps');


     });

     Route::prefix('user')->middleware('user')->group(function(){

        Route::get('/user', function(){
            return view('user.index');
        })->name('user-dashboard');

        Route::get('/appointments', function(){
            return view('user.appoinment');
        })->name('app');



     });


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/logout', [AuthController::class, 'logout'])->name('log');
require __DIR__.'/auth.php';
