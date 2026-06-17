<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'SupplierID';
    public $timestamps = false;

    protected $fillable = [
        'KodeSupplier', 'NamaSupplier', 'PIC', 'NoTelp', 'Email', 'Alamat', 'StatusAktif', 'CreatedAt', 'UpdatedAt'
    ];
}