<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('manufacturer', 'like', "%{$search}%");
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

        // Filter by stock
        if ($request->filled('stock')) {
            if ($request->stock === 'low') {
                $query->whereColumn('stock', '<=', 'min_stock');
            } elseif ($request->stock === 'out') {
                $query->where('stock', '<=', 0);
            }
        }

        $products = $query->latest()->paginate(15);
        $categories = Product::categories();

        // Statistics
        $stats = [
            'total' => Product::count(),
            'active' => Product::where('is_active', true)->count(),
            'low_stock' => Product::whereColumn('stock', '<=', 'min_stock')->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
        ];

        return view('admin.products.index', compact('products', 'categories', 'stats'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Product::categories();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'requires_prescription' => 'boolean',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $validated['image'] = 'products/' . $imageName;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['requires_prescription'] = $request->boolean('requires_prescription', false);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['orderItems.order']);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Product::categories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'requires_prescription' => 'boolean',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            
            $image = $request->file('image');
            $imageName = Str::slug($validated['name']) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $validated['image'] = 'products/' . $imageName;
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['requires_prescription'] = $request->boolean('requires_prescription', false);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Update product stock
     */
    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
            'action' => 'required|in:set,add,subtract',
        ]);

        if ($validated['action'] === 'set') {
            $product->stock = $validated['stock'];
        } elseif ($validated['action'] === 'add') {
            $product->stock += $validated['stock'];
        } else {
            $product->stock = max(0, $product->stock - $validated['stock']);
        }

        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Stok berhasil diperbarui!',
            'stock' => $product->stock,
        ]);
    }

    /**
     * Toggle product active status
     */
    public function toggleStatus(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Status produk berhasil diubah!',
            'is_active' => $product->is_active,
        ]);
    }
}
