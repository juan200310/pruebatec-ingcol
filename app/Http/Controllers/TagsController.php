<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

/**
 * Clase TagsController que contiene los metodos de listado, creacion, actualizacion y eliminacion de una etiqueta
 *
 * @author  Juan Lopez
 */
class TagsController extends Controller
{
    /**
     * Funcion que retorna el listado de todas las etiquetas creadas
     *  
     * @author Juan Lopez
     */
    public function index()
    {
        $tags = Tag::all();
    
        return view('app.tags.index', compact('tags'));
    }

    /**
     * Funcion que retorna la vista de etiquetas
     *  
     * @author Juan Lopez
     */
    public function create()
    {
        return view('app.tags.create');
    }

    /**
     * Funcion que realiza la creacion de las etiquetas
     *  
     * @param TagRequest $request
     * 
     * @author Juan Lopez
     */
    public function store(TagRequest $request)
    {
        $request->validated();

        $tag = new Tag();
        $tag->nombre = $request->input('nombre');
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Etiqueta creada correctamente.');
    }

    /**
     * Funcion que retorna la vista de edicion de una etiqueta
     *  
     * @param int $id
     * 
     * @author Juan Lopez
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        
        return view('app.tags.edit', compact('tag'));
    }

    /**
     * Funcion que realiza la actualizacion de las etiquetas
     *  
     * @param TagRequest $request
     * @param int $id
     * 
     * @author Juan Lopez
     */
    public function update(TagRequest $request, $id)
    {
        $request->validated();

        $tag = Tag::find($id);
        $tag->nombre = $request->input('nombre');
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Etiqueta actualizada correctamente.');
    }

    /**
     * Funcion que realiza la eliminacion de las etiquetas
     *  
     * @param int $id
     * 
     * @author Juan Lopez
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Etiqueta eliminada correctamente.');
    }
}
