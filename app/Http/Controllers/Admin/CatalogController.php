<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display a listing of catalog products.
     */
    public function index(Request $request): View
    {
        $query = Product::query();

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc')->get();

        $categories = [
            'brownies' => 'Brownies',
            'cookies'  => 'Cookies',
            'hampers'  => 'Hampers',
            'cake'     => 'Birthday Cake',
            'pudding'  => 'Pudding',
            'lainnya'  => 'Lainnya',
        ];

        $counts = [
            'total'    => Product::count(),
            'active'   => Product::where('is_active', true)->count(),
            'brownies' => Product::where('category', 'brownies')->count(),
            'cookies'  => Product::where('category', 'cookies')->count(),
            'hampers'  => Product::where('category', 'hampers')->count(),
            'cake'     => Product::where('category', 'cake')->count(),
            'pudding'  => Product::where('category', 'pudding')->count(),
        ];

        return view('admin.catalog.index', compact('products', 'categories', 'counts'));
    }

    /**
     * Show the form for creating a new catalog product.
     */
    public function create(): View
    {
        $categories = [
            'brownies' => 'Brownies',
            'cookies'  => 'Cookies',
            'hampers'  => 'Hampers',
            'cake'     => 'Birthday Cake',
            'pudding'  => 'Pudding',
            'lainnya'  => 'Lainnya',
        ];

        return view('admin.catalog.create', compact('categories'));
    }

    /**
     * Store a newly created catalog product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'in:brownies,cookies,hampers,cake,pudding,lainnya'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price'       => ['required', 'numeric', 'min:0'],
            'price_unit'  => ['required', 'string', 'max:50'],
            'badge'       => ['nullable', 'string', 'max:50'],
            'image'       => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active'   => ['nullable'],
            'sort_order'  => ['nullable', 'integer'],
        ], [
            'name.required'       => 'Nama menu produk wajib diisi.',
            'category.required'   => 'Kategori menu wajib dipilih.',
            'price.required'      => 'Harga produk wajib diisi.',
            'price_unit.required' => 'Satuan harga wajib diisi.',
            'image.required'      => 'Foto katalog menu wajib diunggah.',
            'image.image'         => 'File yang diunggah harus berupa gambar.',
            'image.mimes'         => 'Format gambar yang diperbolehkan: JPG, JPEG, PNG, WEBP.',
            'image.max'           => 'Ukuran gambar maksimal 5MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = FileUploadService::uploadImage($request->file('image'), 'products');
        }

        Product::create([
            'name'        => $validated['name'],
            'category'    => $validated['category'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'price_unit'  => $validated['price_unit'],
            'badge'       => $validated['badge'] ?? null,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.catalog.index')->with('success', 'Menu katalog "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = [
            'brownies' => 'Brownies',
            'cookies'  => 'Cookies',
            'hampers'  => 'Hampers',
            'cake'     => 'Birthday Cake',
            'pudding'  => 'Pudding',
            'lainnya'  => 'Lainnya',
        ];

        return view('admin.catalog.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified catalog product in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'in:brownies,cookies,hampers,cake,pudding,lainnya'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price'       => ['required', 'numeric', 'min:0'],
            'price_unit'  => ['required', 'string', 'max:50'],
            'badge'       => ['nullable', 'string', 'max:50'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active'   => ['nullable'],
            'sort_order'  => ['nullable', 'integer'],
        ], [
            'name.required'       => 'Nama menu produk wajib diisi.',
            'category.required'   => 'Kategori menu wajib dipilih.',
            'price.required'      => 'Harga produk wajib diisi.',
            'price_unit.required' => 'Satuan harga wajib diisi.',
            'image.image'         => 'File yang diunggah harus berupa gambar.',
            'image.mimes'         => 'Format gambar yang diperbolehkan: JPG, JPEG, PNG, WEBP.',
            'image.max'           => 'Ukuran gambar maksimal 5MB.',
        ]);

        $imagePath = $product->image;

        // If user uploaded a new image, replace old file
        if ($request->hasFile('image')) {
            FileUploadService::deleteImage($product->image);
            $imagePath = FileUploadService::uploadImage($request->file('image'), 'products');
        }

        $product->update([
            'name'        => $validated['name'],
            'category'    => $validated['category'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'price_unit'  => $validated['price_unit'],
            'badge'       => $validated['badge'] ?? null,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? $product->sort_order,
        ]);

        return redirect()->route('admin.catalog.index')->with('success', 'Menu katalog "' . $product->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $productName = $product->name;

        // Delete uploaded image file if present
        FileUploadService::deleteImage($product->image);

        $product->delete();

        return redirect()->route('admin.catalog.index')->with('success', 'Menu katalog "' . $productName . '" berhasil dihapus!');
    }

    /**
     * Quick toggle active status.
     */
    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        $status = $product->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', 'Status menu "' . $product->name . '" berhasil ' . $status . '!');
    }
}
