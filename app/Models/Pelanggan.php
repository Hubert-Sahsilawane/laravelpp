<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'pelangganID';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'namaPelanggan',
        'email',
        'alamat',
        'nomor_telepon',
    ];

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'pelangganID', 'PelangganID');
    }
}
