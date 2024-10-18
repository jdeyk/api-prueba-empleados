<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Empleado::with('departamento')->get(); // Cargar empleados junto con su departamento
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fullname' => 'required|string|max:150',
                'correo' => 'required|email|max:150',
                'fecha_nacimiento' => 'nullable|date',
                'isActivo' => 'required|int',
                'departamento_id' => 'required|exists:departamentos,id',
            ]);

            // Si la validación es exitosa, crea el empleado
            $empleado = Empleado::create($request->all());

            // Respuesta exitosa
            return response()->json($empleado, 201); // 201 Created
        } catch (ValidationException $e) {
            // Manejo de errores de validación
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Intentar encontrar el empleado con el ID proporcionado
        $empleado = Empleado::with('departamento')->find($id);

        // Si el empleado no se encuentra, puedes devolver una respuesta con un mensaje
        if (!$empleado) {
            return response()->json([
                'message' => 'Empleado no encontrado'
            ], 404); // Código de estado HTTP 404
        }

        // Si se encuentra, devolver los datos del empleado
        return response()->json($empleado, 200); // Código de estado HTTP 200
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:150',
            'correo' => 'required|email|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'isActivo' => 'required|int',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $empleado->update($request->all());

        return $empleado;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Empleado::destroy($id);
    }
}
