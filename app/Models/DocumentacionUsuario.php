<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentacionUsuario extends Model
{
    use HasFactory;

    protected $table = 'documentacion_usuarios'; // asegúrate que coincida con el nombre de tu tabla

    protected $fillable = [
        'documento',
        'activo',
    ];
}
php artisan make:model DocumentacionUsuario -m

