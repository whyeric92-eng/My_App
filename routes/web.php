<?php
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::post('/update', [ProfileController::class, 'updateUser'])->name('update');
    });
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
});



require __DIR__.'/settings.php';
