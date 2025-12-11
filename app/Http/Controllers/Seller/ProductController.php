<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log; 
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(): View
    {
        // Mendapatkan Toko milik Seller yang sedang login
        $store = Auth::user()->store; 
        
        // Ambil produk yang berelasi dengan toko seller ini
        $products = Product::where('store_id', $store->id)
                            ->latest()
                            ->paginate(10); 
        
        return view('seller.products.index', compact('products'));
    }

    /**
     * Tampilkan form untuk membuat produk baru (CREATE).
     */
    public function create(): View
    {
        // Ambil semua kategori untuk dropdown form
        $categories = ProductCategory::all();
        
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database (STORE).
     */
    public function store(Request $request): RedirectResponse
    {
        $sellerStore = Auth::user()->store;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:1', // Berat dalam gram
            'product_category_id' => ['required', 'exists:product_categories,id'], // ID Kategori harus ada
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Opsional, max 2MB
        ]);

        try {
            DB::beginTransaction();

            // 1. Upload dan Simpan Gambar
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                
                // Resize gambar ke ukuran yang wajar (misalnya 800px)
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg', 80);

                // Simpan ke storage (misalnya folder 'public/products')
                $imagePath = 'products/' . $filename;
                Storage::disk('public')->put($imagePath, $img);
            }

            // 2. Buat Record Produk
            Product::create([
                'store_id' => $sellerStore->id, // Wajib diisi dengan ID Toko Seller
                'product_category_id' => $request->product_category_id,
                'name' => $request->name,
                'slug' => \Illuminate\Support\Str::slug($request->name),
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'description' => $request->description,
                'image' => $imagePath,
                'is_active' => true, // Default aktif
            ]);

            DB::commit();

            return redirect()->route('seller.products.index')->with('success', 'Produk baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Logging error untuk debugging
            Log::error('Product Store Error: ' . $e->getMessage()); 
            
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk. Error: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form untuk mengedit produk (EDIT).
     */
    public function edit(Product $product): View
    {
        // Amankan: Pastikan produk milik seller ini
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403, 'Akses Ditolak. Produk ini bukan milik toko Anda.');
        }

        $categories = ProductCategory::all();
        
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Perbarui produk di database (UPDATE).
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // Amankan: Pastikan produk milik seller ini
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403, 'Akses Ditolak.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:1',
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $data = $request->except(['_token', '_method', 'image']);
            
            // 1. Update/Hapus Gambar Lama jika ada yang baru diupload
            if ($request->hasFile('image')) {
                // Hapus gambar lama (jika ada)
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                // Proses upload dan resize gambar baru (sama seperti store)
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('jpg', 80);
                
                $data['image'] = 'products/' . $filename;
                Storage::disk('public')->put($data['image'], $img);

            }

            // 2. Update Record Produk
            $product->update($data);

            DB::commit();

            return redirect()->route('seller.products.index')->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product Update Error: ' . $e->getMessage());
            
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk. Error: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk dari database (DESTROY).
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Amankan: Pastikan produk milik seller ini
        if ($product->store_id !== Auth::user()->store->id) {
            abort(403, 'Akses Ditolak.');
        }
        
        try {
            // Hapus gambar dari storage jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Product Destroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}