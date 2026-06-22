<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'KategoriID';
    public $timestamps = false;

    protected $fillable = [
        'DepartemenID', 'Nama', 'CreatedAt', 'UpdatedAt'
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'DepartemenID');
    }

    public function subKategori()
    {
        return $this->hasMany(SubKategori::class, 'KategoriID');
    }
}