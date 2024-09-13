<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('pages.Blog.blogs', compact('blogs'));
    }
    public function getAllBlogs(Request $request)
    {
        $query = Blog::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest()->paginate(10);

        return view('pages.Blog.blogs', compact('blogs'));
    }
    public function myBlogs(Request $request)
    {
        $blogs = Blog::where('user_id', Auth::id())->get();
        return view('pages.Blog.myBlogs', compact('blogs'));
    }
    public function create()
    {
        return view('pages.Blog.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('pages.Blog.show', compact('blog'));
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('pages.Blog.edit', compact('blog'));
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $blog = Blog::findOrFail($id);
        if ($blog->user_id == $user->id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->route('blogs.myBlogs')->with('success', 'Blog post created successfully.');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blogs.myBlogs')->with('success', 'Blog post created successfully.');
    }
}