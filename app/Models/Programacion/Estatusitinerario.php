<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_estadias
 * @property string $descripcion
 * @property string $value
 * @property integer $activo
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property ProgramacionEstadia $programacionEstadia
 * @property User $user
 * @property User $user
 */
class Estatusitinerario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estatus_itinerario';

    /**
     * @var array
     */
    protected $fillable = ['programacion_estadias', 'descripcion', 'value', 'activo', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacionEstadia()
    {
        return $this->belongsTo('App\Models\Programacion\EstadiasProgramacionEstadia', 'programacion_estadias');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
}
