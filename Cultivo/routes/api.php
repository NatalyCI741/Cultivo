<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\CultivoApiController;
use App\Models\User;

// Rutas protegidas con autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cultivos', CultivoController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Ruta de registro
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'cliente', // Rol por defecto
    ]);

    return response()->json([
        'token' => $user->createToken('flutter-token')->plainTextToken,
        'user' => $user,
        'message' => 'Registro exitoso'
    ], 201);
});

// Ruta de login
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = Auth::user();

    return response()->json([
        'token' => $user->createToken('flutter-token')->plainTextToken,
        'user' => $user,
    ]);
});

// Recursos de cultivos
Route::apiResource('cultivos', CultivoApiController::class);