<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';
    protected $primaryKey = 'StoreID';
    public $timestamps = false; // We handle it via DB default

    protected $fillable = [
        'KodeStore', 'NamaStore', 'TipeLokasi', 'Alamat', 'NoTelp', 'StatusAktif', 'CreatedAt', 'UpdatedAt'
    ];
}