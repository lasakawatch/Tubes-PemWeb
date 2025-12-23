<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQs.
     */
    public function index(Request $request)
    {
        $query = Faq::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $faqs = $query->ordered()->paginate(15);
        $categories = Faq::categories();

        // Statistics
        $stats = [
            'total' => Faq::count(),
            'active' => Faq::where('is_active', true)->count(),
            'inactive' => Faq::where('is_active', false)->count(),
            'total_views' => Faq::sum('views'),
            'total_helpful' => Faq::sum('helpful_count'),
        ];

        return view('admin.faqs.index', compact('faqs', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        $categories = Faq::categories();
        $maxOrder = Faq::max('order') ?? 0;
        return view('admin.faqs.create', compact('categories', 'maxOrder'));
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Display the specified FAQ.
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        $categories = Faq::categories();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }

    /**
     * Toggle FAQ active status
     */
    public function toggleStatus(Faq $faq)
    {
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return response()->json([
            'success' => true,
            'message' => 'Status FAQ berhasil diubah!',
            'is_active' => $faq->is_active,
        ]);
    }

    /**
     * Reorder FAQs
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'faqs' => 'required|array',
            'faqs.*.id' => 'required|exists:faqs,id',
            'faqs.*.order' => 'required|integer|min:0',
        ]);

        foreach ($validated['faqs'] as $item) {
            Faq::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan FAQ berhasil diperbarui!',
        ]);
    }
}
