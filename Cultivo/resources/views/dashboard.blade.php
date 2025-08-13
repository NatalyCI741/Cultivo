@extends('layouts.master')

<center><h1>Bienvenido Rol Administrador</h1></center>

@section('content')

<div class="card-body">
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso Denegado',
            text: "{{ session('error') }}",
            confirmButtonText: 'Entendido'
        });
    </script>
      </div>
@endif
@endsection