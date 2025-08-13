@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Gestión de Usuarios</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol Actual</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $usuario->role === 'admin' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($usuario->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($usuario->id !== auth()->id())
                                        <button type="button" class="btn btn-sm btn-warning" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cambiarRol{{ $usuario->id }}">
                                            <i class="fas fa-edit"></i> Cambiar Rol
                                        </button>
                                        @else
                                        <span class="text-muted">Tu cuenta</span>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Modal para cambiar rol --}}
                                <div class="modal fade" id="cambiarRol{{ $usuario->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.usuarios.update-role', $usuario) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cambiar Rol - {{ $usuario->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Seleccionar nuevo rol:</label>
                                                        <select name="role" class="form-select" required>
                                                            <option value="cliente" {{ $usuario->role === 'cliente' ? 'selected' : '' }}>
                                                                Cliente
                                                            </option>
                                                            <option value="admin" {{ $usuario->role === 'admin' ? 'selected' : '' }}>
                                                                Administrador
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        Cambiar Rol
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection