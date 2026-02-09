<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:tags',
        ]);

        Tag::create($data);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
    }

    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:50|unique:tags,name,' . $id,
        ]);

        $tag->update($data);

        return redirect()->route('tags.index')->with('success', 'Tag updated!');
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted!');
    }
}