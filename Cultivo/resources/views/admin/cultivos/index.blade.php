@extends('layouts.master')

@section('tituloPagina', 'Gestión de Cultivos')

@section('content')
<div class="container-fluid">
    <!-- Header mejorado -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="cultivos-header p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h1 class="text-white fw-bold mb-2">
                    <i class="fas fa-seedling me-3"></i>
                    Gestión de Cultivos
                </h1>
                <p class="text-white-50 mb-0">
                    Administra todos los cultivos del sistema
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i>Lista de Cultivos
                    </h5>
                    <a href="/admin/cultivos/create" class="btn btn-light btn-lg rounded-pill shadow">
                        <i class="fas fa-plus me-2"></i>
                        ✨ Nuevo Cultivo
                    </a>
                </div>
                
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-0">{{ session('success') }}</h6>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($cultivos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-hashtag me-2"></i>ID
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-seedling me-2"></i>Nombre
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-leaf me-2"></i>Tipo
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-calendar me-2"></i>Fecha
                                        </th>
                                        <th class="border-0 fw-bold text-muted text-center">
                                            <i class="fas fa-cogs me-2"></i>Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cultivos as $cultivo)
                                        <tr class="cultivo-row">
                                            <td class="fw-semibold">{{ $cultivo->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="cultivo-icon me-3">
                                                        <i class="fas fa-seedling"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-success">{{ $cultivo->nombre }}</div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>
                                                            {{ $cultivo->created_at->diffForHumans() }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark fs-6 px-3 py-2">
                                                    <i class="fas fa-leaf me-2 text-primary"></i>
                                                    {{ $cultivo->tipo }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($cultivo->fecha)
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-calendar-check text-info me-2"></i>
                                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($cultivo->fecha)->format('d/m/Y') }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-calendar-times me-2"></i>
                                                        Sin fecha
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="/admin/cultivos/{{ $cultivo->id }}/edit" class="btn btn-outline-warning btn-sm rounded-pill me-2" title="Editar">
                                                        <i class="fas fa-edit me-1"></i>
                                                        Editar
                                                    </a>
                                                    <form action="/admin/cultivos/{{ $cultivo->id }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este cultivo?')">
                                                            <i class="fas fa-trash me-1"></i>
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-seedling fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">No hay cultivos registrados</h5>
                            <p class="text-muted mb-4">¡Comienza creando tu primer cultivo!</p>
                            <a href="/admin/cultivos/create" class="btn btn-success btn-lg rounded-pill shadow">
                                <i class="fas fa-plus me-2"></i>
                                ✨ Crear Primer Cultivo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cultivos-header {
    position: relative;
    overflow: hidden;
}

.cultivos-header::before {
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
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
}

.cultivo-row {
    transition: all 0.3s ease;
}

.cultivo-row:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.cultivo-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #28a745, #20c997);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.btn-outline-warning:hover,
.btn-outline-danger:hover {
    transform: translateY(-2px);
}

.table th {
    padding: 1rem 0.75rem;
}

.table td {
    padding: 1rem 0.75rem;
    border-top: 1px solid #f1f3f4;
}

.alert {
    border-radius: 15px;
}

.btn-lg {
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-2px);
}
</style>
@endsection
