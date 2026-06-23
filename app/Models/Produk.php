<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'ProdukID';
    public $timestamps = false;

    protected $fillable = [
        'BrandID', 'KategoriID', 'SubKategoriID', 'SKU', 'Barcode', 'NamaProduk', 'Satuan', 'MinStok', 'MaxStok', 'Deskripsi', 'StatusAktif', 'CreatedAt', 'UpdatedAt'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KategoriID');
    }

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class, 'SubKategoriID');
    }

    public function inventori()
    {
        return $this->hasMany(Inventori::class, 'ProdukID');
    }
}