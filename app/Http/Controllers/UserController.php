<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    // Verificar si se solicita paginación
    if ($request->has('per_page')) {
        // Obtener el número de elementos por página desde el query parameter 'per_page', por defecto es 15
        $perPage = $request->input('per_page', 15);
        
        // Realizar la paginación
        $users = User::paginate($perPage);
        
        // Retornar la paginación con los datos y el número total de elementos
        return response()->json([
            'data' => $users->items(), // Los elementos de la página actual
            'total' => $users->total()  // El número total de elementos
        ]);
    } else {
        // Obtener todos los usuarios si no se solicita paginación
        $users = User::all();
        return response()->json($users);
    }
}


    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
       // Encontrar y eliminar el usuario
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(null, 204);
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json($user, 200);
    }
}
