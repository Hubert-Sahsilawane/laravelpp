<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all(); // Menghapus relasi 'kategori'
        return response()->json($produk);
    }

    public function store(Request $request)
{
    $request->validate([
        'namaProduk' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    $produk = Produk::where('namaProduk', $request->namaProduk)->first();

    if ($produk) {
        $produk->stok += $request->stok;
        $produk->harga = $request->harga;
        $produk->save();
        $message = 'Stok produk berhasil ditambahkan.';
    } else {
        Produk::create([
            'namaProduk' => $request->namaProduk,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        $message = 'Produk baru berhasil ditambahkan.';
    }

    return response()->json(['message' => $message], 201);
}

    public function show(string $id)
    {
        $produk = Produk::findOrFail($id);
       return response()->json([
            'status' => true,
            'message' => 'data berhasil ditemukan',
            'data' => $produk
        ]);
    }

    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'namaProduk' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation failed',
            'error' => $validator->errors()
        ], 422);
    }

    $produk = Produk::findOrFail($id);
    $produk->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Produk berhasil diperbarui',
        'data' => $produk
    ], 200);
}

public function destroy(string $id)
{
    $produk = Produk::findOrFail($id);
    $produk->delete();
    return response()->json([
        'status' => true,
        'message' => 'Data Berhasil Dihapus',
    ], 204);
}
}
