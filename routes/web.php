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

Route::get('/', function () {
    return redirect()->route('login');  // Redirect to login page when visiting the root
});


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

        Route::get('/All-residents', function(){
            return view('admin.all-redidents');
        })->name('res');

        Route::get('/0-71months', function(){
            return view('admin.0-71months');
        })->name('months');

        Route::get('/Bp-monitoring', function(){
            return view('admin.bp');
        })->name('bps');

        Route::get('/admin.annoucement', function(){
            return view('admin.annoucement');
        })->name('admin.annoucement');

        Route::get('/admin.pregnancy', function(){
            return view('admin.pregnancy');
        })->name('admin.pregnancy');

        Route::get('/admin.birthregistry', function(){
            return view('admin.birthregistry');
        })->name('admin.birthregistry');

        Route::get('/admin.reschedule', function(){
            return view('admin.reschedule');
        })->name('admin.reschedule');

        Route::get('/admin.masterlist', function(){
            return view('admin.masterlist');
        })->name('admin.masterlist');

        Route::get('/admin.medical_record', function(){
            return view('admin.medical_record');
        })->name('admin.medical_record');


     });

     Route::prefix('user')->middleware('user')->group(function(){

        Route::get('/user', function(){
            return view('user.index');
        })->name('user-dashboard');

        Route::get('/appointments', function(){
            return view('user.appoinment');
        })->name('app');



     });

     Route::get('/login', function () {
        return view('auth.login');  // Make sure the login page exists here
    })->name('login');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/logout', [AuthController::class, 'logout'])->name('log');
require __DIR__.'/auth.php';
