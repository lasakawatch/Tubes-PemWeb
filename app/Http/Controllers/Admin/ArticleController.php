<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Article::with('author');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->latest()->paginate(15);
        $categories = Article::categories();

        // Statistics
        $stats = [
            'total' => Article::count(),
            'published' => Article::where('status', 'published')->count(),
            'draft' => Article::where('status', 'draft')->count(),
            'total_views' => Article::sum('views'),
        ];

        return view('admin.articles.index', compact('articles', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Article::categories();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = Str::slug($validated['title']) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $imageName);
            $validated['featured_image'] = 'articles/' . $imageName;
        }

        // Process tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = Auth::id();

        // Set published_at if publishing
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        $article->load('author');
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $categories = Article::categories();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image) {
                Storage::delete('public/' . $article->featured_image);
            }
            
            $image = $request->file('featured_image');
            $imageName = Str::slug($validated['title']) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $imageName);
            $validated['featured_image'] = 'articles/' . $imageName;
        }

        // Process tags
        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = null;
        }

        // Update slug if title changed
        if ($validated['title'] !== $article->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set published_at if publishing for the first time
        if ($validated['status'] === 'published' && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->featured_image) {
            Storage::delete('public/' . $article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Publish an article
     */
    public function publish(Article $article)
    {
        $article->status = 'published';
        if (!$article->published_at) {
            $article->published_at = now();
        }
        $article->save();

        return redirect()->back()->with('success', 'Artikel berhasil dipublikasikan!');
    }

    /**
     * Unpublish an article
     */
    public function unpublish(Article $article)
    {
        $article->status = 'draft';
        $article->save();

        return redirect()->back()->with('success', 'Artikel berhasil dibatalkan publikasinya!');
    }
}
