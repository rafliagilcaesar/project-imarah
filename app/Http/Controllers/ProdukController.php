<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategoriNama')->get();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all(); // Assuming you want to pass categories to the view
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request) 
    {
    $validated = $request->validate([
        'nama_produk'  => 'required|string|max:255',
        'slug'         => 'required|string|max:255|unique:produks,slug',
        'harga'        => 'required|numeric|min:0',
        'kategori'  => 'required|exists:kategori,id',
        'gambar'         => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // kalau ini gambar
        'deskripsi'    => 'required|string',
    ], [
        'required' => ':attribute wajib diisi.',
        'unique'   => ':attribute sudah digunakan.',
        'exists'   => ':attribute tidak valid.',
        'mimes'    => 'File harus JPG atau PNG.',
        'max'      => 'Ukuran file maksimal 2MB.',
    ]);

    if ($request->hasFile('gambar')) {

    // Simpan gambar baru dengan nama unik di folder "produk" (storage/app/public/produk)
    $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
    }


    Produk::create($validated);

    return redirect()
        ->route('produk.index')
        ->with('success', 'Produk berhasil ditambahkan.');
}


    public function show($id)
    {
        $produk = Produk::with('kategoriNama')->findOrFail($id);

        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
{
    $validated = $request->validate([
        'nama_produk'  => 'required|string|max:255',
        'slug'         => [
            'required',
            'string',
            'max:255',
        ],
        'harga'        => 'required|numeric|min:0',
        'kategori'     => 'required|exists:kategori,id',
        'gambar'       => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'deskripsi'    => 'required|string',
    ], [
        'required' => ':attribute wajib diisi.',
        'unique'   => ':attribute sudah digunakan.',
        'exists'   => ':attribute tidak valid.',
        'mimes'    => 'File harus JPG atau PNG.',
        'max'      => 'Ukuran file maksimal 2MB.',
    ]);

    // kalau ada upload gambar baru
    if ($request->hasFile('gambar')) {
        // hapus gambar lama jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // simpan gambar baru
        $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
    }

    // update data
    $produk->update($validated);

    return redirect()
        ->route('produk.index')
        ->with('success', 'Produk berhasil diperbarui.');
}

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
