<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductCategory; // Menggunakan Model yang benar

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori (Index).
     */
    public function index(): View
    {
        // Mengambil semua kategori dengan relasi parent, 10 per halaman
        $categories = ProductCategory::with('parent')->latest()->paginate(10);
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru (Create).
     */
    public function create(): View
    {
        // Mengambil semua kategori untuk dijadikan opsi Parent Category
        $categories = ProductCategory::all();
        
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Menyimpan data kategori baru (Store).
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'parent_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'tagline' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $data = $request->except('_token', 'image');
        $data['slug'] = Str::slug($request->name);

        // 2. Penanganan Upload Gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/categories');
            // Menghapus 'public/' dari path untuk penyimpanan di database
            $data['image'] = str_replace('public/', '', $data['image']);
        }
        
        // 3. Simpan ke Database
        ProductCategory::create($data); // Menggunakan fillable: parent_id, image, name, slug, tagline, description

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori (Edit).
     */
    public function edit(ProductCategory $category): View
    {
        // Mengambil semua kategori (digunakan sebagai opsi Parent Category)
        $categories = ProductCategory::all();
        
        // $category adalah instance Model yang akan diedit
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Mengupdate data kategori (Update).
     */
    public function update(Request $request, ProductCategory $category): RedirectResponse
    {
        // 1. Validasi Data
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $category->id, // Abaikan ID saat ini
            'parent_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'tagline' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->except('_token', '_method', 'image');
        $data['slug'] = Str::slug($request->name);
        
        // 2. Penanganan Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('public/categories');
            $data['image'] = str_replace('public/', '', $data['image']);
        }
        
        // 3. Update ke Database
        $category->update($data);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (Destroy).
     */
    public function destroy(ProductCategory $category): RedirectResponse
    {
        // Cek apakah kategori memiliki anak atau produk (Pencegahan)
        if ($category->children()->count() > 0 || $category->products()->count() > 0) {
             return redirect()->route('admin.categories.index')
                             ->with('error', 'Kategori tidak dapat dihapus karena memiliki sub-kategori atau produk terkait.');
        }

        // Hapus gambar terkait (jika ada)
        if ($category->image) {
            Storage::delete('public/' . $category->image);
        }
        
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}