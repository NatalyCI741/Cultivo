@extends('layouts.master')

@section('tituloPagina', 'Gestión de Usuarios')

@section('content')
<div class="container-fluid">
    <!-- Header mejorado -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="users-header p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);">
                <h1 class="text-white fw-bold mb-2">
                    <i class="fas fa-users me-3"></i>
                    Gestión de Usuarios
                </h1>
                <p class="text-white-50 mb-0">
                    Administra los usuarios y sus roles en el sistema
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
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

                    @if($usuarios->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-hashtag me-2"></i>ID
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-user me-2"></i>Usuario
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-envelope me-2"></i>Email
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-shield-alt me-2"></i>Rol
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-seedling me-2"></i>Cultivos
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-calendar me-2"></i>Registro
                                        </th>
                                        <th class="border-0 fw-bold text-muted text-center">
                                            <i class="fas fa-cogs me-2"></i>Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                        <tr class="user-row">
                                            <td class="fw-semibold">{{ $usuario->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $usuario->name }}</div>
                                                        @if($usuario->id === auth()->id())
                                                            <small class="text-success">
                                                                <i class="fas fa-star me-1"></i>Usuario actual
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ $usuario->email }}</span>
                                            </td>
                                            <td>
                                                <span class="badge fs-6 px-3 py-2 {{ $usuario->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                                    <i class="fas fa-{{ $usuario->role === 'admin' ? 'crown' : 'user' }} me-2"></i>
                                                    {{ ucfirst($usuario->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="cultivos-count me-2">{{ $usuario->cultivos_count }}</div>
                                                    <i class="fas fa-seedling text-success"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $usuario->created_at->format('d/m/Y') }}</small>
                                            </td>
                                            <td class="text-center">
                                                @if($usuario->id !== auth()->id())
                                                    <div class="btn-group" role="group">
                                                        <form action="/admin/usuarios/{{ $usuario->id }}/cambiar-rol" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-warning btn-sm rounded-pill me-2" title="Cambiar Rol">
                                                                <i class="fas fa-exchange-alt me-1"></i>
                                                                Cambiar Rol
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="/admin/usuarios/{{ $usuario->id }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                                <i class="fas fa-trash me-1"></i>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="badge bg-light text-success">
                                                        <i class="fas fa-shield-alt me-1"></i>
                                                        Protegido
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-users fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">No hay usuarios registrados</h5>
                            <p class="text-muted">Los usuarios aparecerán aquí cuando se registren</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.users-header {
    position: relative;
    overflow: hidden;
}

.users-header::before {
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

.user-row {
    transition: all 0.3s ease;
}

.user-row:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.avatar-circle {
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

.cultivos-count {
    font-weight: bold;
    font-size: 1.1rem;
    color: #28a745;
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
</style>
@endsection
