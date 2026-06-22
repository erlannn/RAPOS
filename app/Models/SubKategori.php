<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'SubKategoriID';
    public $timestamps = false;

    protected $fillable = [
        'KategoriID', 'Nama', 'CreatedAt', 'UpdatedAt'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'KategoriID');
    }
}