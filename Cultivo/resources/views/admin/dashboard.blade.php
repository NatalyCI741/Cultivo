@extends('layouts.master')

@section('tituloPagina', 'Dashboard Administrativo')

@section('content')
<div class="container-fluid">
    <!-- Header Mejorado -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <div class="welcome-header p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h1 class="display-4 text-white fw-bold mb-2">
                    <i class="fas fa-seedling me-3"></i>
                    ¡Bienvenido, {{ Auth::user()->name }}! 🌱
                </h1>
                <p class="lead text-white-50 mb-0">
                    <i class="fas fa-crown me-2"></i>
                    Panel de Administración del Sistema de Cultivos
                </p>
                <div class="mt-3">
                    <span class="badge bg-light text-success fs-6 px-3 py-2">
                        <i class="fas fa-user-shield me-2"></i>Administrador
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 4px solid #007bff !important;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                Total Usuarios
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalUsuarios }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 4px solid #28a745 !important;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-2">
                                Administradores
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalAdmins }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-user-shield text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 4px solid #17a2b8 !important;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-2">
                                Clientes
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalClientes }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-info">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card" style="border-left: 4px solid #ffc107 !important;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">
                                Cultivos
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalCultivos }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-seedling text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gestión de Cultivos -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-seedling me-2"></i>Gestión de Cultivos
                    </h5>
                    <a href="/admin/cultivos/create" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Nuevo Cultivo
                    </a>
                </div>
                <div class="card-body">
                    @if($totalCultivos > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cultivosRecientes as $cultivo)
                                        <tr>
                                            <td class="fw-semibold">{{ $cultivo->nombre }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $cultivo->tipo }}</span>
                                            </td>
                                            <td>{{ $cultivo->fecha ? $cultivo->fecha->format('d/m/Y') : 'N/A' }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="/admin/cultivos/{{ $cultivo->id }}/edit" class="btn btn-outline-warning" title="Editar">
                                                        <i class="fas fa-edit">
                                                        <br></i>
                                                    </a>
                                                    -
                                                    <form action="/admin/cultivos/{{ $cultivo->id }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este cultivo?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="/admin/cultivos" class="btn btn-success">
                                <i class="fas fa-list me-2"></i>Ver Todos los Cultivos
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-seedling fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">No hay cultivos registrados</h5>
                            <p class="text-muted mb-4">¡Comienza creando tu primer cultivo!</p>
                            <a href="/admin/cultivos/create" class="btn btn-success btn-lg">
                                <i class="fas fa-plus me-2"></i>Crear Primer Cultivo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Gestión de Usuarios -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-users me-2"></i>Gestión de Usuarios
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-users-cog fa-3x text-info mb-3"></i>
                        <p class="text-muted">Administra los usuarios y sus roles en el sistema</p>
                    </div>
                    <a href="/admin/usuarios" class="btn btn-info">
                        <i class="fas fa-users me-2"></i>Gestionar Usuarios
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.welcome-header {
    position: relative;
    overflow: hidden;
}

.welcome-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(1deg); }
}

.stats-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.card {
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}
</style>
@endsection
