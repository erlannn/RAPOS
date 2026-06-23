<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiStok extends Model
{
    use HasFactory;

    protected $table = 'mutasi_stok';
    protected $primaryKey = 'MutasiID';
    public $timestamps = false;

    protected $fillable = [
        'Tanggal', 'ProdukID', 'StoreID', 'JenisMutasi', 'ReferensiTabel', 'ReferensiID', 'Qty', 'SaldoSebelum', 'SaldoSesudah', 'Keterangan', 'UserID', 'CreatedAt'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'StoreID');
    }
}