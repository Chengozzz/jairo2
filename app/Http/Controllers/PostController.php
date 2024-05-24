<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\View\View;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all(); // Recupera todos los posts de la base de datos
        return view('post.index', compact('posts')); // Pasa los posts a la vista
        //return view('post.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear un nuevo post
        $post = new Post();
        $post->titulo = $validatedData['titulo'];
        $post->descripcion = $validatedData['descripcion'];
        $post->user_id = auth()->user()->id; // Asume que estás usando autenticación y el usuario está autenticado

        // Manejar la imagen subida si existe
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('images', 'public');
            $post->image_path = $imagePath;
        }

        $post->save();

        return redirect()->route('post/index')->with('success', 'Post creado exitosamente.');
        //
        // $post = post::make($request->validated());
        // $post->user_id = auth()->user()->id;
        // $post->save();

       // return redirect()->route('dasboard')->with('success', 'Tarea creada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }
}
