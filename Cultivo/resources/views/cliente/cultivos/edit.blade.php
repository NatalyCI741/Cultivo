@extends('layouts.master')

@section('tituloPagina', 'Editar Cultivo')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Header mejorado -->
            <div class="text-center mb-4">
                <div class="edit-header p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);">
                    <h2 class="text-white fw-bold mb-2">
                        <i class="fas fa-edit me-3"></i>
                        ✏️ Editar Cultivo
                    </h2>
                    <p class="text-white-50 mb-0">
                        Modifica los datos de tu cultivo
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">¡Oops! Hay algunos errores:</h6>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="/cliente/cultivos/{{ $cultivo->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nombre del Cultivo -->
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold fs-5">
                                <i class="fas fa-seedling text-primary me-2"></i>
                                Nombre del Cultivo
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-seedling text-primary"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 @error('nombre') is-invalid @enderror" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="{{ old('nombre', $cultivo->nombre) }}" 
                                       placeholder="Ej: Fresa, Papa, Tomate..."
                                       required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Tipo del Cultivo -->
                        <div class="mb-4">
                            <label for="tipo" class="form-label fw-bold fs-5">
                                <i class="fas fa-leaf text-primary me-2"></i>
                                Tipo del Cultivo
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-leaf text-primary"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 @error('tipo') is-invalid @enderror" 
                                       id="tipo" 
                                       name="tipo" 
                                       value="{{ old('tipo', $cultivo->tipo) }}" 
                                       placeholder="Ej: Dulce, Roja, Pequeña, Grande..."
                                       required>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Puedes escribir cualquier descripción: color, tamaño, variedad, etc.
                            </div>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-5">
                            <label for="fecha" class="form-label fw-bold fs-5">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                Fecha del Cultivo
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-calendar text-primary"></i>
                                </span>
                                <input type="date" 
                                       class="form-control border-start-0 @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha', $cultivo->fecha ? $cultivo->fecha->format('Y-m-d') : '') }}">
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Fecha actual: {{ $cultivo->fecha ? $cultivo->fecha->format('d/m/Y') : 'No establecida' }}
                            </div>
                        </div>

                        <!-- Botones mejorados -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="/cliente/cultivos" class="btn btn-outline-secondary btn-lg w-100 rounded-pill">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Cancelar
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                                    <i class="fas fa-save me-2"></i>
                                    💾 Actualizar Cultivo
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info adicional -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>
                    Cultivo creado: {{ $cultivo->created_at->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>
    </div>
</div>

<style>
.edit-header {
    position: relative;
    overflow: hidden;
}

.edit-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(1deg); }
}

.card {
    border-radius: 20px;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.input-group-text {
    border-radius: 15px 0 0 15px;
}

.form-control {
    border-radius: 0 15px 15px 0;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-lg {
    padding: 15px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.5rem;
}

.alert {
    border-radius: 15px;
}
</style>
@endsection
