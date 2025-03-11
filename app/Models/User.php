<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable
{
    use HasFactory, HasRoles; 

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];
}
