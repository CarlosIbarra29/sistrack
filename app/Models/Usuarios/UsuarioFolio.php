<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $folio
 * @property string $anio
 * @property string $created_at
 * @property string $updated_at
 */
class UsuarioFolio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_folio';

    /**
     * @var array
     */
    protected $fillable = ['folio', 'anio', 'created_at', 'updated_at'];
}
