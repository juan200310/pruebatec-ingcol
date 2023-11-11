<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
    
        return view('app.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('app.tags.create');
    }

    public function store(TagRequest $request)
    {
        $request->validated();

        $tag = new Tag();
        $tag->nombre = $request->input('nombre');
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Etiqueta creada correctamente.');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        
        return view('app.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        $request->validated();

        $tag = Tag::find($id);
        $tag->nombre = $request->input('nombre');
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Etiqueta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Etiqueta eliminada correctamente.');
    }
}
