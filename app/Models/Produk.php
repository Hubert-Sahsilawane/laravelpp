<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'produkID'; 
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['namaProduk', 'harga', 'stok'];

    public static function createOrUpdateStock(array $data)
    {
        $produk = self::where('namaProduk', $data['namaProduk'])->first();

        if ($produk) {
            $produk->stok += $data['stok'];
            $produk->harga = $data['harga'];
            $produk->save();
        } else {
            self::create($data);
        }
    }
}
