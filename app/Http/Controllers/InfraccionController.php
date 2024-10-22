<?php

namespace App\Http\Controllers;

use App\Models\Infraccion;
use Illuminate\Http\Request;

class InfraccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $registros = Infraccion::where('id', 'LIKE', '%' . $texto . '%')
                    ->orWhere('dni', 'LIKE', '%' . $texto . '%')
                    ->orWhere('placa', 'LIKE', '%' . $texto . '%')
                    ->orWhere('infraccion', 'LIKE', '%' . $texto . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        return view('infraccion.index', compact(['registros', 'texto']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('infraccion.action', ['infraccion' => new Infraccion()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'fecha' => 'required|date',
            'placa' => 'required|string|max:7',
            'infraccion' => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:255',
        ]);

        try {
            $registro = Infraccion::create($request->all());
            return redirect()->route('infraccion.index')->with('mensaje', 'Registro ' . $registro->infraccion . ' creado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('infraccion.index')->with('error', 'No se puede crear el registro');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Infraccion $infraccion)
    {
        return view('infraccion.show', compact('infraccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infraccion $infraccion)
    {
        return view('infraccion.action', compact('infraccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infraccion $infraccion)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'fecha' => 'required|date',
            'placa' => 'required|string|max:7',
            'infraccion' => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:255',
        ]);

        try {
            $infraccion->update($request->all());
            return redirect()->route('infraccion.index')->with('mensaje', 'Registro ' . $infraccion->infraccion . ' actualizado satisfactoriamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('infraccion.index')->with('error', 'No se puede actualizar el registro');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infraccion $infraccion)
    {
        try {
            $infraccion->delete();
            return redirect()->route('infraccion.index')->with('mensaje', 'Registro ' . $infraccion->infraccion . ' eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('infraccion.index')->with('error', 'No se puede eliminar el registro ' . $infraccion->infraccion . ' porque está siendo usado.');
        }
    }
}
