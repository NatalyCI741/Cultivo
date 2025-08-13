@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
<!-- Header mejorado con animación -->
<div class="auth-header">
    <div class="logo-container">
        <div class="logo-circle">
            <i class="fas fa-seedling"></i>
        </div>
    </div>
    <h1 class="auth-title">Sistema de Cultivos</h1>
    <p class="auth-subtitle">Bienvenido de vuelta 🌱</p>
</div>

<!-- Formulario mejorado -->
<div class="auth-card">
    <div class="auth-card-header">
        <h3 class="mb-0">
            <i class="fas fa-sign-in-alt me-2 text-success"></i>
            Iniciar Sesión
        </h3>
        <p class="text-muted mb-0">Accede a tu cuenta</p>
    </div>

    <div class="auth-card-body">
        @if (session('status'))
            <div class="alert alert-success alert-modern fade show" role="alert">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>¡Éxito!</strong>
                    <p class="mb-0">{{ session('status') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-modern fade show" role="alert">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-content">
                    <strong>¡Oops!</strong>
                    <p class="mb-1">Verifica los datos ingresados:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="/login" class="auth-form">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope text-primary me-2"></i>
                    Correo Electrónico
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-at"></i>
                    </span>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="ejemplo@correo.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock text-warning me-2"></i>
                    Contraseña
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Tu contraseña segura">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <div class="form-check custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        <i class="fas fa-heart text-danger me-1"></i>
                        Recordarme en este dispositivo
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-auth w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Iniciar Sesión
                    <div class="btn-ripple"></div>
                </button>
            </div>

            <!-- Links -->
            <div class="auth-links">
                <div class="text-center">
                    <div class="divider">
                        <span>o</span>
                    </div>
                    <p class="mb-0">
                        ¿No tienes cuenta? 
                        <a href="/register" class="auth-link">
                            <i class="fas fa-user-plus me-1"></i>
                            ¡Regístrate gratis!
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<div class="auth-footer">
    <p class="text-muted text-center mb-0">
        <i class="fas fa-shield-alt me-1"></i>
        Tus datos están seguros con nosotros
    </p>
</div>
@endsection
