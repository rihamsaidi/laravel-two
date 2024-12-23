<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|nullable',
        ]);

        $post = Post::create($request->only(['title', 'description']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function show($id)
    {
        $post = Post::with('images')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|nullable',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'description']));

        // اذا حذفت الصور بعد ما حددتهن
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $post->images()->findOrFail($imageId);
                \Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }
    // هون اذا رفعت صور جديدين
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $post->images()->create(['image_path' => $path]);
            }
        }
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
