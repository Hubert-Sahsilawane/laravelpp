<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model {
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'produkID';
    protected $fillable = ['namaProduk', 'harga', 'stok'];

    public function detailPenjualan() {
        return $this->hasMany(DetailPenjualan::class, 'produkID', 'produkID');
    }
}
