<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curp;
class CurpController extends Controller
{
    //
    public function index()
    {
        return Curp::all();

    }

    public function store (Request $request)
    {
        $validatedData = $request->validate([
            'curp' => 'required|unique:curps|max:18',
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:H,M',
            'entidad' => 'required|string|max:255',
        ]);
        $curp = Curp::create($validatedData);

        return response()->json($curp, 201);
    }

    public function show($id)
    {
        return Curp::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $curp = Curp::findOrFail($id);

        $validatedData = $request->validate([
            'curp' => 'sometimes|required|unique:curps,curp,'.$id.'|max:18',
            'nombre' => 'sometimes|required|string|max:255',
            'apellido_paterno' => 'sometimes|required|string|max:255',
            'apellido_materno' => 'sometimes|required|string|max:255',
            'fecha_nacimiento' => 'sometimes|required|date',
            'sexo' => 'sometimes|required|in:H,M',
            'entidad' => 'sometimes|required|string|max:255',
        ]);

        $curp->update($validatedData);

        return response()->json($curp);
    }

    public function destroy($id)
    {
        $curp = Curp::findOrFail($id);
        $curp ->delete();

        return response()->json(null, 204);
    }
}
