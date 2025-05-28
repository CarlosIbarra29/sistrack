<?php

namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_id
 * @property integer $custodio_id
 * @property string $created_at
 * @property string $updated_at
 * @property Programacion $programacion
 * @property Custodio $custodio
 */
class AcompanantesProgramacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion_acompanantes';

    /**
     * @var array
     */
    protected $fillable = ['programacion_id', 'custodio_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacion()
    {
        return $this->belongsTo('App\Models\Programacion\Programacion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function custodio()
    {
        return $this->belongsTo('App\Models\Custodio\Custodio');
    }
}
