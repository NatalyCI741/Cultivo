<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cultivo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Verificar que el usuario sea admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        // Obtener estadísticas
        $totalUsuarios = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalClientes = User::where('role', 'cliente')->count();
        $totalCultivos = Cultivo::count();

        // Obtener cultivos recientes (máximo 5)
        $cultivosRecientes = Cultivo::with('user')
                                   ->latest()
                                   ->take(5)
                                   ->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalAdmins', 
            'totalClientes',
            'totalCultivos',
            'cultivosRecientes'
        ));
    }

    public function usuarios()
    {
        $usuarios = User::withCount('cultivos')->orderBy('created_at', 'desc')->get();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function cambiarRol(User $usuario)
    {
        // No permitir cambiar el rol del usuario actual
        if ($usuario->id === auth()->id()) {
            return redirect('/admin/usuarios')->with('error', 'No puedes cambiar tu propio rol.');
        }

        // Cambiar el rol
        $nuevoRol = $usuario->role === 'admin' ? 'cliente' : 'admin';
        $usuario->update(['role' => $nuevoRol]);

        return redirect('/admin/usuarios')->with('success', "Rol cambiado a {$nuevoRol} exitosamente.");
    }

    public function eliminarUsuario(User $usuario)
    {
        // No permitir eliminar el usuario actual
        if ($usuario->id === auth()->id()) {
            return redirect('/admin/usuarios')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        // Eliminar cultivos asociados
        $usuario->cultivos()->delete();
        
        // Eliminar usuario
        $usuario->delete();

        return redirect('/admin/usuarios')->with('success', 'Usuario eliminado exitosamente.');
    }
}
