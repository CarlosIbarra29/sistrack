<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property string $valdat_fecha
 * @property string $valdat_comentario
 * @property string $verref_fecha
 * @property string $verref_comentario
 * @property string $verlab_fecha
 * @property string $verlab_comentario
 * @property string $anasoc_fecha
 * @property string $anasoc_comentario
 * @property string $exafis_fecha
 * @property string $exafis_comentario
 * @property string $examed_fecha
 * @property string $examed_comentario
 * @property string $exapsi_fecha
 * @property string $exapsi_comentario
 * @property string $exatox_fecha
 * @property string $exatox_comentario
 * @property string $tesver_fecha
 * @property string $tesver_comentario
 * @property string $tesrob_fecha
 * @property string $tesrob_comentario
 * @property string $tesnor_fecha
 * @property string $tesnor_comentario
 * @property string $tessob_fecha
 * @property string $tessob_comentario
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property User $user
 * @property User $user
 * @property Custodio $custodio
 */
class CustodioControlConfianza extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_controlconfianza';

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'valdat_fecha', 'valdat_comentario', 'verref_fecha', 'verref_comentario', 'verlab_fecha', 'verlab_comentario', 'anasoc_fecha', 'anasoc_comentario', 'exafis_fecha', 'exafis_comentario', 'examed_fecha', 'examed_comentario', 'exapsi_fecha', 'exapsi_comentario', 'exatox_fecha', 'exatox_comentario', 'tesver_fecha', 'tesver_comentario', 'tesrob_fecha', 'tesrob_comentario', 'tesnor_fecha', 'tesnor_comentario', 'tessob_fecha', 'tessob_comentario', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
    
    public function custodio()
    {
        return $this->belongsTo('App\Models\Custodio\Custodio');
    }
}
