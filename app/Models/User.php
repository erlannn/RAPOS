<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    protected $fillable = [
        'StoreID', 'Nama', 'Username', 'Email', 'Password', 'StatusAktif', 'LastLogin', 'CreatedAt', 'UpdatedAt'
    ];

    protected $hidden = [
        'Password',
    ];
    
    public function getAuthPassword()
    {
        return $this->Password;
    }
}