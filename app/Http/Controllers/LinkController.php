<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $query = Link::with(['category', 'tags'])
            ->where(function($q) use ($user) {
                if ($user->roles()->where('name', 'admin')->exists()) {
                    return;
                }
                $q->where('user_id', $user->id)
                  ->orWhereHas('sharedWith', function($sq) use ($user) {
                      $sq->where('users.id', $user->id);
                  });
            });

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
        $users = User::where('id', '!=', $user->id)->get();

        return view('links.index', compact('links', 'categories', 'tags', 'users'));
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
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isShared = $link->sharedWith()->where('users.id', $user->id)->exists();

        if ($link->user_id !== $user->id && !$isShared && !$user->roles()->where('name', 'admin')->exists()) {
            abort(403);
        }

        $link->load(['category', 'tags']);
        return view('links.show', compact('link'));
    }

    public function edit(Link $link)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $canEdit = $link->user_id === $user->id || 
                   $link->sharedWith()->where('users.id', $user->id)
                        ->where('permission', 'edit')->exists();

        if (!$canEdit && !$user->roles()->where('name', 'admin')->exists()) {
            abort(403);
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('links.edit', compact('link', 'categories', 'tags'));
    }

    public function update(Request $request, Link $link)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $canEdit = $link->user_id === $user->id || 
                   $link->sharedWith()->where('users.id', $user->id)
                        ->where('permission', 'edit')->exists();

        if (!$canEdit && !$user->roles()->where('name', 'admin')->exists()) {
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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($link->user_id !== $user->id && !$user->roles()->where('name', 'admin')->exists()) {
            abort(403);
        }

        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully');
    }

    public function forceDelete($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->roles()->where('name', 'admin')->exists()) {
            abort(403);
        }
        
        $link = Link::withTrashed()->findOrFail($id);
        $link->forceDelete();
        return back()->with('success', 'Deleted permanently');
    }

    public function toggleFavorite(Link $link)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->favorites()->toggle($link->id);
        return back()->with('success', 'Favorites updated');
    }

    public function share(Request $request, Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|in:read,edit',
        ]);

        $link->sharedWith()->syncWithoutDetaching([
            $request->user_id => ['permission' => $request->permission]
        ]);

        return back()->with('success', 'Link shared successfully');
    }
}