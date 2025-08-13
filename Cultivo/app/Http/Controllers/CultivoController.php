<?php

namespace App\Http\Controllers;

use App\Models\Cultivo;
use Illuminate\Http\Request;

class CultivoController extends Controller
{
    // Métodos para Admin (CRUD completo)
    public function adminIndex()
    {
        $cultivos = Cultivo::orderBy('created_at', 'desc')->get();
        return view('admin.cultivos.index', compact('cultivos'));
    }

    public function adminCreate()
    {
        return view('admin.cultivos.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cultivos,nombre',
            'tipo' => 'required|string|max:255',
            'fecha' => 'nullable|date'
        ], [
            'nombre.unique' => 'Ya existe un cultivo con este nombre. Por favor, elige un nombre diferente.',
            'nombre.required' => 'El nombre del cultivo es obligatorio.',
            'tipo.required' => 'El tipo del cultivo es obligatorio.'
        ]);

        $cultivo = new Cultivo();
        $cultivo->nombre = $request->nombre;
        $cultivo->tipo = $request->tipo;
        $cultivo->fecha = $request->fecha;
        $cultivo->user_id = auth()->id() ?? 0;
        $cultivo->save();

        return redirect('/admin/cultivos')->with('success', 'Cultivo creado exitosamente');
    }

    public function adminEdit($id)
    {
        $cultivo = Cultivo::findOrFail($id);
        return view('admin.cultivos.edit', compact('cultivo'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $cultivo = Cultivo::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255|unique:cultivos,nombre,' . $id,
            'tipo' => 'required|string|max:255',
            'fecha' => 'nullable|date'
        ], [
            'nombre.unique' => 'Ya existe otro cultivo con este nombre.',
            'nombre.required' => 'El nombre del cultivo es obligatorio.',
            'tipo.required' => 'El tipo del cultivo es obligatorio.'
        ]);

        $cultivo->nombre = $request->nombre;
        $cultivo->tipo = $request->tipo;
        $cultivo->fecha = $request->fecha;
        $cultivo->save();

        return redirect('/admin/cultivos')->with('success', 'Cultivo actualizado exitosamente');
    }

    public function adminDestroy($id)
    {
        $cultivo = Cultivo::findOrFail($id);
        $cultivo->delete();
        return redirect('/admin/cultivos')->with('success', 'Cultivo eliminado exitosamente');
    }

    // Método para Cliente (Solo visualización)
    public function clienteIndex()
    {
        // Los clientes ven TODOS los cultivos que el admin ha agregado
        $cultivos = Cultivo::orderBy('created_at', 'desc')->get();
        $totalCultivos = $cultivos->count();
        
        return view('cliente.cultivos.index', compact('cultivos', 'totalCultivos'));
    }
}
