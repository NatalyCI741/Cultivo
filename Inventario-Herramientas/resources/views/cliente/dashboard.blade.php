@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="card shadow-lg p-4" style="width: 50rem; border-radius: 15px; background-color: #f1faee;">
            <div class="card-header text-white text-center" style="border-radius: 10px 10px 0 0; background-color: #2A9D8F;">
                <h1>Bienvenido Cliente</h1>
            </div>
            <div class="card-body text-center">
                @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Acceso Denegado',
                            text: "{{ session('error') }}",
                            confirmButtonText: 'Entendido'
                        });
                    </script>
                @endif

                <!-- Botón para ver lista de herramientas -->
                <div class="mt-3">
                    <a href="{{ route('herramienta.index') }}" class="btn text-white px-4 py-2" style="background-color: #264653; border-color: #264653;">
                        <i class="fas fa-warehouse"></i> Ver...
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
