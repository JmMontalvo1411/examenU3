<?php

namespace App\Http\Controllers;

use App\Models\Cliente; // Asegúrate de que el modelo esté importado correctamente
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Método para listar todos los clientes
    public function index()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes de la base de datos
        return view('clientes.index', compact('clientes')); // Pasar los clientes a la vista
    }

    // Método para mostrar el formulario de creación de un nuevo cliente
    public function create()
    {
        return view('clientes.create'); // Retorna la vista del formulario de creación
    }

    // Método para guardar un nuevo cliente en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|max:255',
            'email' => 'required|email|unique:clientes,email',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:15',
        ]);

        Cliente::create($request->all()); // Crear un nuevo cliente con los datos validados

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente creado exitosamente.');
    }

    // Método para mostrar la vista de un cliente específico
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente')); // Pasar el cliente a la vista
    }

    // Método para mostrar el formulario de edición de un cliente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente')); // Pasar el cliente a la vista de edición
    }

    // Método para actualizar un cliente en la base de datos
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => 'required|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:15',
        ]);

        $cliente->update($request->all()); // Actualizar el cliente con los datos validados

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente actualizado exitosamente.');
    }

    // Método para eliminar un cliente de la base de datos
    public function destroy(Cliente $cliente)
    {
        $cliente->delete(); // Eliminar el cliente

        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente eliminado exitosamente.');
    }
}
