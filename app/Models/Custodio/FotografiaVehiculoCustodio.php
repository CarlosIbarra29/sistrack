<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property string $fotografia
 * @property string $mime_type
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property Custodio $custodio
 * @property User $user
 * @property User $user
 */
class FotografiaVehiculoCustodio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_fotografia_vehiculo';

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'fotografia', 'mime_type', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

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
