@extends('layouts.app')

@section('content')
<style>
        nav ul {
    display: none;
}
nav.navbar {
    display: none !important;
}

    :root {
        --primary-color: #0a6ebd;
        --secondary-color: #1eb980;
        --background-color: #f4f7fa;
        --text-color: #333;
        --error-color: #e74c3c;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .register-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
    }

    .register-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #ffffff;
        padding: 100px;
        text-align: center;
    }

    .register-header h1 {
        font-size: 24px;
        font-weight: 600;
    }

    .register-form {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .form-group .error {
        color: var(--error-color);
        font-size: 14px;
    }

    .register-button {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
    }

    .register-button:hover {
        opacity: 0.9;
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
    }

    .login-link a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>
<div class="register-container">
    <div class="register-header">
        <h1>Registro</h1>
        <p>Únete a Bodega de Herramientas</p>
    </div>
    <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirmar Contraseña</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" class="register-button">Registrarse</button>
    </form>
    <div class="login-link">
        <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
</div>
@endsection