<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase_orders';

    protected $fillable = [
        'sku',
        'nama_produk',
        'stock',
        'min',
        'max',
        'jumlah_beli',
        'satuan',
        'isi_kardus',
        'harga_satuan',
        'total_harga',
    ];
}
?>
