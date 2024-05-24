<?php

namespace App\Http\Controllers;

use App\Models\comentario;
use App\Http\Requests\StorecomentarioRequest;
use App\Http\Requests\UpdatecomentarioRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecomentarioRequest $request)
    {
        //No tocar aun no jala!
         // Validar los datos del formulario
         $request->validate([
            'post_id' => 'required|exists:posts,id',
            'descripcion' => 'required|string|max:255',
        ]);

        // Crear un nuevo comentario
        $comentario = new Comentario();
        $comentario->post_id = $request->post_id;
        $comentario->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $comentario->descripcion = $request->descripcion;
        $comentario->save();
        
        // Redirigir de nuevo a la misma página
        return redirect()->back()->with('success', 'Comentario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecomentarioRequest $request, comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comentario $comentario)
    {
        //
    }
}
