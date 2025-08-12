<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HerramientaController;

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

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación protegidas por el middleware centralizado
Auth::routes(['middleware' => 'role.redirect']);

// Rutas protegidas por roles
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente', function () {
        return view('cliente.dashboard');
    })->name('cliente.dashboard');
});

Route::get('/herramienta/herramientas', [herramientaController::class, 'create'])->name('herramienta.create');
Route::post('/herramienta/store', [herramientaController::class, 'store'])->name('herramienta.store');
Route::get('/listac', [herramientaController::class, 'index'])->name('herramienta.index');
Route::put('/herramienta/{id}', [herramientaController::class, 'update'])->name('herramientas.update');
Route::delete('/herramienta/{id}', [herramientaController::class, 'destroy'])->name('herramienta.destroy');
Route::get('/herramienta', [HerramientaController::class, 'index'])->name('herramientas.index');

Route::get('/herramienta/{id}/edit', [HerramientaController::class, 'edit'])->name('herramienta.edit');
Route::delete('/herramienta/{id}', [herramientaController::class, 'destroy'])->name('herramienta.destroy');


