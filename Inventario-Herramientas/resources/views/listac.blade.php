@extends('layouts.master')

@section('tituloPagina', 'Lista de Herramientas')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4" style="border-radius: 15px; background-color: #f1faee;">
        <div class="card-header text-center" style="border-radius: 10px 10px 0 0; background-color: #2A9D8F; color: white;">
            <h2 class="mb-0">Lista de Herramientas</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark" style="background-color: #264653; color: white;">
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            @if(auth()->user()->role == 'admin') {{-- Solo los admins ven esta columna --}}
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($herramientas as $herramienta)
                        <tr>
                            <td>{{ $herramienta->id }}</td>
                            <td>{{ $herramienta->descripcion }}</td>
                            <td>{{ $herramienta->cantidad }}</td>
                            @if(auth()->user()->role == 'admin') {{-- Solo los admins ven los botones --}}
                                <td>
                                    <button class="btn btn-warning btn-sm btn-edit" 
                                        data-id="{{ $herramienta->id }}" 
                                        data-descripcion="{{ $herramienta->descripcion }}" 
                                        data-cantidad="{{ $herramienta->cantidad }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <form action="{{ route('herramienta.destroy', $herramienta->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este elemento?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role == 'admin') {{-- Solo los admins pueden editar --}}
<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2A9D8F; color: white;">
                <h5 class="modal-title" id="editModalLabel">Editar Herramienta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #f1faee;">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-id" name="id">
                    
                    <div class="mb-3">
                        <label for="edit-descripcion" class="form-label fw-bold">Descripción</label>
                        <input type="text" class="form-control" id="edit-descripcion" name="descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-cantidad" class="form-label fw-bold">Cantidad</label>
                        <input type="number" class="form-control" id="edit-cantidad" name="cantidad" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" style="background-color: #264653; border-color: #264653;">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function () {
            let id = this.getAttribute("data-id");
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-descripcion").value = this.getAttribute("data-descripcion");
            document.getElementById("edit-cantidad").value = this.getAttribute("data-cantidad");
            document.getElementById("editForm").action = `/herramienta/${id}`;
        });
    });
});
</script>

@endsection
