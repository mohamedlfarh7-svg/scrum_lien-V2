<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $query = Link::with(['category', 'tags'])->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        $links = $query->latest()->get();
        $categories = Category::all();
        $tags = Tag::all();

        return view('links.index', compact('links', 'categories', 'tags'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('links.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'required|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $data['user_id'] = Auth::id();

        $link = Link::create($data);
        $link->tags()->attach($request->tags);

        return redirect()->route('links.index')->with('success', 'Link added successfully');
    }

    public function show(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $link->load(['category', 'tags']);
        return view('links.show', compact('link'));
    }

    public function edit(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('links.edit', compact('link', 'categories', 'tags'));
    }

    public function update(Request $request, Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'required|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $link->update($data);
        $link->tags()->sync($request->tags);

        return redirect()->route('links.index')->with('success', 'Link updated successfully');
    }

    public function destroy(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully');
    }
    public function forceDelete($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        
        $link = Link::withTrashed()->findOrFail($id);
        $link->forceDelete();
        return back()->with('success', 'Supprimé définitivement');
    }
    public function toggleFavorite(Link $link)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            $user->favorites()->toggle($link->id);
        }

        return back()->with('success', 'Favoris mis à jour');
    }
}