@extends('layouts.master')

@section('tituloPagina', 'Sistema de Cultivos')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <section class="bg-success text-white py-5" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        <i class="fas fa-seedling me-3"></i>
                        Sistema de Gestión de Cultivos
                    </h1>
                    <p class="lead mb-4">
                        Plataforma integral para la gestión y administración de cultivos rentables. 
                        Controla, monitorea y optimiza tus cultivos de manera eficiente.
                    </p>
                    
                    @guest
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                                <i class="fas fa-user-plus me-2"></i>Registrarse
                            </a>
                        </div>
                    @else
                        <div class="d-flex gap-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4">
                                <i class="fas fa-tachometer-alt me-2"></i>Ir al Dashboard
                            </a>
                        </div>
                    @endguest
                </div>
                
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <i class="fas fa-leaf text-white-50" style="font-size: 20rem; opacity: 0.1;"></i>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <i class="fas fa-seedling text-white" style="font-size: 8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-5 fw-bold text-success mb-3">Características del Sistema</h2>
                    <p class="lead text-muted">Todo lo que necesitas para gestionar tus cultivos</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-seedling text-success" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title">Gestión de Cultivos</h5>
                            <p class="card-text text-muted">
                                Administra todos tus cultivos desde una sola plataforma. 
                                Registra, edita y elimina cultivos de manera sencilla.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-users text-info" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title">Roles de Usuario</h5>
                            <p class="card-text text-muted">
                                Sistema de roles diferenciado entre administradores y clientes 
                                con permisos específicos para cada tipo de usuario.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-chart-line text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title">Interfaz Intuitiva</h5>
                            <p class="card-text text-muted">
                                Diseño responsive y fácil de usar. 
                                Accede desde cualquier dispositivo con una experiencia optimizada.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @guest
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h2 class="display-6 fw-bold mb-3">¿Listo para comenzar?</h2>
            <p class="lead mb-4">Únete a nuestra plataforma y optimiza la gestión de tus cultivos</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                    <i class="fas fa-rocket me-2"></i>Comenzar Ahora
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                    <i class="fas fa-sign-in-alt me-2"></i>Ya tengo cuenta
                </a>
            </div>
        </div>
    </section>
    @endguest
</div>
@endsection