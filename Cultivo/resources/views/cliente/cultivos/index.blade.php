@extends('layouts.master')

@section('tituloPagina', 'Catálogo de Cultivos')

@section('content')
<div class="container-fluid">
    <!-- Header mejorado -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="cultivos-header p-4 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #17a2b8 0%, #007bff 100%);">
                <h1 class="text-white fw-bold mb-2">
                    <i class="fas fa-seedling me-3"></i>
                    Catálogo de Cultivos
                </h1>
                <p class="text-white-50 mb-0">
                </p>
                     <p class="lead text-white-50 mb-0">
                    Bienvenido al catálogo de cultivos, donde podrás explorar todos los cultivos disponibles.
                </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
        <div class="col-md-4 mx-auto">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="icon-circle bg-info me-3">
                            <i class="fas fa-seedling text-white"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold text-info">{{ $totalCultivos }}</h3>
                            <p class="text-muted mb-0">Cultivos Disponibles</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i>Lista de Cultivos Disponibles
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    @if($cultivos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-hashtag me-2"></i>ID
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-seedling me-2"></i>Nombre del Cultivo
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-leaf me-2"></i>Tipo/Variedad
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-calendar me-2"></i>Fecha de Registro
                                        </th>
                                        <th class="border-0 fw-bold text-muted">
                                            <i class="fas fa-clock me-2"></i>Agregado
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cultivos as $cultivo)
                                        <tr class="cultivo-row">
                                            <td class="fw-semibold text-info">{{ $cultivo->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="cultivo-icon me-3">
                                                        <i class="fas fa-seedling"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark fs-5">{{ $cultivo->nombre }}</div>
                                                        <small class="text-success">
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            Disponible
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark fs-6 px-3 py-2 border">
                                                    <i class="fas fa-leaf me-2 text-success"></i>
                                                    {{ $cultivo->tipo }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($cultivo->fecha)
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-calendar-check text-success me-2"></i>
                                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($cultivo->fecha)->format('d/m/Y') }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-calendar-times me-2"></i>
                                                        Sin fecha específica
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $cultivo->created_at->diffForHumans() }}
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    {{ $cultivo->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Información adicional -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        <small class="text-muted">
                                            <strong>Información:</strong> Esta es una vista de solo lectura
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shield-alt text-warning me-2"></i>
                                        <small class="text-muted">
                                            <strong>Permisos:</strong> Solo visualización
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-shield text-success me-2"></i>
                                        <small class="text-muted">
                                            <strong>Gestión:</strong> Solo administradores
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-seedling fa-4x text-muted"></i>
                            </div>
                            <h5 class="text-muted mb-3">No hay cultivos disponibles</h5>
                            <p class="text-muted mb-4">El administrador aún no ha agregado cultivos al sistema</p>
                            <div class="alert alert-info border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                                    <div>
                                        <h6 class="alert-heading mb-1">Información</h6>
                                        <p class="mb-0">Los cultivos aparecerán aquí cuando el administrador los agregue al sistema.</p>
                                    </div>
                                </div>
                            </div>
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
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #17a2b8, #007bff);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
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

.table th {
    padding: 1rem 0.75rem;
    font-size: 0.9rem;
}

.table td {
    padding: 1.2rem 0.75rem;
    border-top: 1px solid #f1f3f4;
}

.alert {
    border-radius: 15px;
}

.badge {
    font-weight: 500;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection
