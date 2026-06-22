<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventori extends Model
{
    use HasFactory;

    protected $table = 'inventori';
    protected $primaryKey = 'InventoriID';
    public $timestamps = false;

    protected $fillable = [
        'ProdukID', 'StoreID', 'StokSaatIni', 'MinimumStok', 'HargaBeliTerakhir', 'HargaJual', 'CreatedAt', 'UpdatedAt'
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