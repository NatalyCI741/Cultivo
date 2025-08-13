<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CultivoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
})->name('home');

// Rutas de autenticación personalizadas (sobrescribir Fortify)
Route::get('/login', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Ruta de logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard principal
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    return redirect('/cliente/cultivos');
})->name('dashboard');

// Rutas para Administradores (CRUD completo)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::post('/usuarios/{usuario}/cambiar-rol', [AdminController::class, 'cambiarRol'])->name('usuarios.cambiar-rol');
    Route::delete('/usuarios/{usuario}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
    
    // Rutas de cultivos para admin (CRUD completo)
    Route::get('/cultivos', [CultivoController::class, 'adminIndex'])->name('cultivos.index');
    Route::get('/cultivos/create', [CultivoController::class, 'adminCreate'])->name('cultivos.create');
    Route::post('/cultivos', [CultivoController::class, 'adminStore'])->name('cultivos.store');
    Route::get('/cultivos/{id}/edit', [CultivoController::class, 'adminEdit'])->name('cultivos.edit');
    Route::put('/cultivos/{id}', [CultivoController::class, 'adminUpdate'])->name('cultivos.update');
    Route::delete('/cultivos/{id}', [CultivoController::class, 'adminDestroy'])->name('cultivos.destroy');
});

// Rutas para Clientes (Solo visualización)
Route::middleware(['auth'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/cultivos', [CultivoController::class, 'clienteIndex'])->name('cultivos.index');
});
