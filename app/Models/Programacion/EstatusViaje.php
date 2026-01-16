<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $estatus_viaje
 * @property string $created_at
 */
class EstatusViaje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estatus_viaje';

    /**
     * @var array
     */
    protected $fillable = ['estatus_viaje', 'created_at'];
}
