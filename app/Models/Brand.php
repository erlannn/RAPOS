<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';
    protected $primaryKey = 'BrandID';
    public $timestamps = false;

    protected $fillable = [
        'NamaBrand', 'StatusAktif', 'CreatedAt', 'UpdatedAt'
    ];
}