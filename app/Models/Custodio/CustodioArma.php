<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property string $registro_arma
 * @property string $vigencia_portacion
 * @property string $observaciones
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property User $user
 * @property Custodio $custodio
 * @property User $user
 */
class CustodioArma extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_arma';

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'registro_arma', 'vigencia_portacion', 'observaciones', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function custodio()
    {
        return $this->belongsTo('App\Models\Custodio\Custodio');
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
