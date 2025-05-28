<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property string $entin_fecha
 * @property string $entin_comentario
 * @property string $verdoc_fecha
 * @property string $verdoc_comentario
 * @property string $entope_fecha
 * @property string $entope_comentario
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property Custodio $custodio
 * @property User $user
 * @property User $user
 */
class CustodioSeleccion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_seleccion';

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'entin_fecha', 'entin_comentario', 'verdoc_fecha', 'verdoc_comentario', 'entope_fecha', 'entope_comentario', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

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
