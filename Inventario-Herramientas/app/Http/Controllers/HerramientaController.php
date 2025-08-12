<?php

namespace App\Http\Controllers;

use App\Models\Herramienta;
use Illuminate\Http\Request;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = Herramienta::all(); 
        return view('listac', compact('herramientas')); 
    }
    

    public function create()
    {
        return view('herramientas');
    }

    public function store(Request $request)
    {
        $herramienta = new Herramienta();
        $herramienta->nombre = $request->post('nombre');
        $herramienta->descripcion = $request->post('descripcion');
        $herramienta->cantidad = $request->post('cantidad');
        $herramienta->save();

        return redirect()->route('herramientas.index');
    }

    public function update(Request $request, $id)
    {
        $herramienta = Herramienta::findOrFail($id);
        $herramienta->nombre = $request->input('nombre');
        $herramienta->descripcion = $request->input('descripcion');
        $herramienta->cantidad = $request->input('cantidad');
        $herramienta->save();

        return redirect()->route('herramientas.index');
    }

    public function destroy($id)
    {
        if (auth()->user()->role != 'admin') {
            return redirect()->route('herramienta.index')->with('error', 'Acceso denegado.');
        }
    
        $item = herramienta::findOrFail($id);
        $item->delete();
        return redirect()->route('herramienta.index')->with('success', 'Elemento eliminado.');
    }
    
    public function edit($id)
{
    if (auth()->user()->role != 'admin') {
        return redirect()->route('herramienta.index')->with('error', 'Acceso denegado.');
    }

    $item = herramienta::findOrFail($id);
    return view('inventario.edit', compact('item'));
}


}


  

