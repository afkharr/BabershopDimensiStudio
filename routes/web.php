
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {
        'owner' => redirect()->route('admin.dashboard'),
        'barber' => redirect()->route('barber.dashboard'),
        default => abort(403, 'Role akun tidak dikenali.'),
    };
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'store'])
        ->name('login.store');
});

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



Route::middleware(['auth', 'role:owner'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
    });


Route::middleware(['auth', 'role:barber'])
    ->prefix('barber')
    ->name('barber.')
    ->group(function () {

        // Dashboard Barber
        Route::get('/dashboard', function () {
            return view('barber.dashboard');
        })->name('dashboard');
    });
