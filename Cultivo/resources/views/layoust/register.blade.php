@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
<!-- Header mejorado -->
<div class="auth-header">
    <div class="logo-container">
        <div class="logo-circle">
            <i class="fas fa-seedling"></i>
        </div>
    </div>
    <h1 class="auth-title">Sistema de Cultivos</h1>
    <p class="auth-subtitle">¡Únete a nuestra comunidad! 🌱</p>
</div>

<!-- Formulario mejorado -->
<div class="auth-card">
    <div class="auth-card-header">
        <h3 class="mb-0">
            <i class="fas fa-user-plus me-2 text-primary"></i>
            Crear Cuenta
        </h3>
        <p class="text-muted mb-0">Regístrate gratis en segundos</p>
    </div>

    <div class="auth-card-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-modern fade show" role="alert">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-content">
                    <strong>¡Oops!</strong>
                    <p class="mb-1">Corrige los siguientes errores:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="/register" class="auth-form">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user text-info me-2"></i>
                    Nombre Completo
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-id-card"></i>
                    </span>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="Tu nombre completo">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

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
                           autocomplete="new-password"
                           placeholder="Mínimo 8 caracteres">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="password-strength mt-2">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <small class="text-muted" id="strengthText">Ingresa tu contraseña</small>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock text-success me-2"></i>
                    Confirmar Contraseña
                </label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-check-double"></i>
                    </span>
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Repite tu contraseña">
                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Hidden role field -->
            <input type="hidden" name="role" value="cliente">

            <!-- Terms and Conditions -->
            <div class="form-group">
                <div class="form-check custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms">
                        <i class="fas fa-shield-check text-success me-1"></i>
                        Acepto los <a href="#" class="auth-link">términos y condiciones</a>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-auth w-100">
                    <i class="fas fa-user-plus me-2"></i>
                    Crear Mi Cuenta
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
                        ¿Ya tienes cuenta? 
                        <a href="/login" class="auth-link">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            ¡Inicia sesión aquí!
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
        <i class="fas fa-users me-1"></i>
        Únete a miles de usuarios que confían en nosotros
    </p>
</div>
@endsection
