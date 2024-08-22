<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PharmacyController;
/*use App\Http\Controllers\PrescriptionController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
});

Route::middleware(['auth', 'pharmacy'])->group(function () {
    Route::get('/pharmacy/prescriptions', [PharmacyController::class, 'index'])->name('pharmacy.prescriptions.index');
    Route::get('/pharmacy/prescriptions/{id}', [PharmacyController::class, 'show'])->name('pharmacy.prescriptions.show');
    Route::post('/pharmacy/prescriptions/{id}/quote', [PharmacyController::class, 'storeQuote'])->name('pharmacy.prescriptions.quote');
});
require __DIR__.'/auth.php';
