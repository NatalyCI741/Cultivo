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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 200%;
        max-width: -30px;
        
    transform: translateX(-70px); /* Mueve 50px a la izquierda */


    }

    .login-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #ffffff;
        padding: 30px;
        text-align: center;
    }

    .login-header h1 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .login-form {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 800px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .form-group .error {
        color: var(--error-color);
        font-size: 14px;
        margin-top: 5px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .remember-me input {
        margin-right: 10px;
    }

    .login-button {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #ffffff;
        border: none;
        border-radius: 5px;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .login-button:hover {
        opacity: 0.9;
    }

    .forgot-password {
        text-align: center;
        margin-top: 20px;
    }

    .forgot-password a {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 14px;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-container">
                <div class="login-header">
                    <h1>Iniciar Sesión</h1>
                    <p>Bienvenido a Bodega de Herramientas</p>
                </div>

                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Recuérdame</label>
                        </div>

                        <button type="submit" class="login-button">Iniciar Sesión</button>

                        <div class="forgot-password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
