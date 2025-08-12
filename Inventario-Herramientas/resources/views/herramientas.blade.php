@extends('layouts.master')

@section('tituloPagina', 'Registro de herramientas')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-lg p-4" style="width: 50rem; border-radius: 15px; background-color: #3f3e3a;">
        <div class="card-header text-white text-center" style="border-radius: 10px 10px 0 0; background-color: #ffffff;">
            <h2>Registrar Herramienta</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('herramienta.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="fw-bold">Nombre de la herramienta:</label>
                    <input type="text" name="nombre" placeholder="Nombre herramienta" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Descripción de la herramienta:</label>
                    <input type="text" name="descripcion" placeholder="Descripción herramienta" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Cantidad de la herramienta:</label>
                    <input type="number" name="cantidad" placeholder="Cantidad de herramienta" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2" style="background-color: #4f4e4c; border-color: #ccc4ba;">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection