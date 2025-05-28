<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property string $vehiculo
 * @property string $modelo
 * @property string $no_serie
 * @property string $placa
 * @property string $color
 * @property integer $gps
 * @property string $no_gps
 * @property string $observaciones
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property Custodio $custodio
 * @property User $user
 * @property User $user
 */
class CustodioVehiculo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_vehiculo';

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'vehiculo', 'modelo', 'year_unidad' , 'no_serie', 'placa', 'color', 'gps', 'no_gps', 'observaciones', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

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
