<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cultivo;

class CultivoApiController extends Controller
{
    public function index()
    {
        return response()->json(Cultivo::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $cultivo = Cultivo::create($request->all());

        return response()->json($cultivo, 201);
    }

    public function show($id)
    {
        $cultivo = Cultivo::find($id);

        if (!$cultivo) {
            return response()->json(['error' => 'Cultivo no encontrado'], 404);
        }

        return response()->json($cultivo);
    }

    public function update(Request $request, $id)
    {
        $cultivo = Cultivo::find($id);

        if (!$cultivo) {
            return response()->json(['error' => 'Cultivo no encontrado'], 404);
        }

        $cultivo->update($request->all());

        return response()->json($cultivo);
    }

    public function destroy($id)
    {
        $cultivo = Cultivo::find($id);

        if (!$cultivo) {
            return response()->json(['error' => 'Cultivo no encontrado'], 404);
        }

        $cultivo->delete();

        return response()->json(['message' => 'Cultivo eliminado correctamente']);
    }
}